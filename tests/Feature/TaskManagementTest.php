<?php

namespace Tests\Feature;

use App\Mail\TaskCompleted;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_and_task_list_are_accessible_to_guests(): void
    {
        $this->get('/')->assertOk();
        $this->get('/tasks')->assertOk();
        $this->get('/profile')->assertOk();
        $this->get('/about')->assertOk();
    }

    public function test_guest_can_view_a_task_but_cannot_manage_tasks(): void
    {
        $task = Task::create(['title' => 'Plan the day', 'status' => 'pending']);

        $this->get(route('tasks.show', $task))->assertOk();
        $this->get(route('tasks.create'))->assertRedirect(route('login'));
        $this->get(route('tasks.edit', $task))->assertRedirect(route('login'));
        $this->post(route('tasks.store'), [])->assertRedirect(route('login'));
        $this->put(route('tasks.update', $task), [])->assertRedirect(route('login'));
        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_edit_and_archive_a_task(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('tasks.create'))->assertOk();
        $this->post(route('tasks.store'), [
            'title' => 'Write report',
            'description' => 'Draft the weekly report',
            'due_date' => '2026-12-01',
            'status' => 'pending',
        ])->assertRedirect();

        $task = Task::firstOrFail();
        $this->assertSame('Write report', $task->title);
        $this->get(route('tasks.edit', $task))->assertOk();

        $this->put(route('tasks.update', $task), [
            'title' => 'Finish report',
            'description' => 'Review and submit',
            'due_date' => '',
            'status' => 'in_progress',
        ])->assertRedirect(route('tasks.show', $task));

        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'is_archived' => true]);
        $this->get(route('tasks.index'))->assertDontSee('Finish report');
    }

    public function test_invalid_task_data_is_rejected(): void
    {
        $this->actingAs(User::factory()->create())
            ->from(route('tasks.create'))
            ->post(route('tasks.store'), [
                'title' => '',
                'status' => 'unknown',
            ])
            ->assertSessionHasErrors(['title', 'status']);
    }

    public function test_completion_notification_is_sent_only_on_transition_to_done(): void
    {
        Mail::fake();
        $this->actingAs(User::factory()->create());
        $task = Task::create(['title' => 'Ship release', 'status' => 'pending']);

        $this->put(route('tasks.update', $task), [
            'title' => $task->title,
            'status' => 'done',
        ])->assertRedirect();

        Mail::assertSent(TaskCompleted::class, function (TaskCompleted $mail) {
            return $mail->hasTo(config('tasks.completed_recipient'))
                && $mail->task->status === 'done'
                && str_contains($mail->render(), 'Ship release');
        });
        Mail::assertSent(TaskCompleted::class, 1);

        $this->put(route('tasks.update', $task), [
            'title' => 'Ship release',
            'status' => 'done',
        ])->assertRedirect();

        Mail::assertSent(TaskCompleted::class, 1);
    }

    public function test_updating_an_already_done_task_does_not_send_notification(): void
    {
        Mail::fake();
        $this->actingAs(User::factory()->create());
        $task = Task::create(['title' => 'Already complete', 'status' => 'done']);

        $this->put(route('tasks.update', $task), [
            'title' => 'Already complete',
            'status' => 'done',
        ])->assertRedirect();

        Mail::assertNothingSent();
    }
}
