<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.index',compact('tasks')
        );
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'min:3','max:150',],

                'description' => ['nullable', 'string', 'max:1000',],

                'due_date' => ['nullable', 'date', 'after_or_equal:today',],

                'priority' => ['required', 'in:alta,media,baja',],

                'status' => ['required', 'in:pendiente,en_proceso,completada',
                ],
            ],

            [
                'title.required' => 'El título es obligatorio.',

                'title.min' => 'El título debe tener mínimo 3 caracteres.',

                'title.max' => 'El título no puede superar 150 caracteres.',

                'description.max' => 'La descripción no puede superar 1000 caracteres.',

                'due_date.after_or_equal' => 'La fecha no puede ser anterior a hoy.',

                'priority.required' => 'Selecciona una prioridad.',

                'priority.in' => 'La prioridad seleccionada no es válida.',

                'status.required' => 'Selecciona un estado.',

                'status.in' => 'El estado seleccionado no es válido.',
            ]
        );


        auth()
            ->user()
            ->tasks()
            ->create($validated);


        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'La tarea se registró correctamente.'
            );
    }


    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        return view(
            'tasks.edit',
            compact('task')
        );
    }


    public function update(
        Request $request,
        Task $task
    ) {

        $this->authorizeTask($task);


        $validated = $request->validate(
            [
                'title' => [
                    'required',
                    'string',
                    'min:3',
                    'max:150',
                ],

                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],

                'due_date' => [
                    'nullable',
                    'date',
                ],

                'priority' => [
                    'required',
                    'in:alta,media,baja',
                ],

                'status' => [
                    'required',
                    'in:pendiente,en_proceso,completada',
                ],
            ]
        );


        $task->update($validated);


        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'La tarea se actualizó correctamente.'
            );
    }


    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();


        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'La tarea se eliminó correctamente.'
            );
    }


    public function completed()
    {
        $tasks = auth()
            ->user()
            ->tasks()
            ->where(
                'status',
                'completada'
            )
            ->latest('updated_at')
            ->get();


        return view(
            'tasks.completed',
            compact('tasks')
        );
    }


    private function authorizeTask(Task $task)
    {
        if (
            $task->user_id !== auth()->id()
        ) {
            abort(403);
        }
    }
}