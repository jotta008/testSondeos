<?php

namespace App\Console\Commands;

use App\Models\Books as ModelsBooks;
use App\Models\Genders as ModelsGenders;
use Illuminate\Console\Command;

class Genders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genders {action?} {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manejo por CLI de Géneros';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $action = $this->argument('action');
        if ($action === 'getAll') {
            $this->getAll();
        } elseif ($action === 'getById') {
            $this->getById();
        } elseif ($action === 'create') {
            $this->create();
        } elseif ($action === 'update') {
            $this->update();
        } elseif ($action === 'delete') {
            $this->delete();
        } else {
            $this->info('Comandos disponibles:');
            $this->line('- getAll');
            $this->line('- getById');
            $this->line('- create');
            $this->line('- update');
            $this->line('- delete');
        }
    }
    public function getAll()
    {
        $this->info('Géneros');
        $headers = ['Id','Name'];

        
        $genders = ModelsGenders::where('active', 1)
        ->get(['id','name'])
        ->toArray();
        $this->table($headers, $genders);
    }
    public function getById()
    {
        $id = $this->argument('id');

        $gender = ModelsGenders::find($id);
        if (!$gender) {
            $this->error('El género con el ID especificado no existe.');
            return;
        }
        $gender = $gender->toArray();
        $columnas = ['id', 'name'];
        $gender = array_intersect_key($gender, array_flip($columnas));
        $headers = ['Id', 'name'];
        $this->table($headers, [$gender]);
    }
    public function create()
    {
        $this->info('Crear género');

        $name = '';
        while (empty($name)) {
            $name = $this->ask('Nombre');
            if (empty($name)) {
                $this->error('El Nombre no puede estar vacío');
            }
        }
        
        $gender = new ModelsGenders();
        $gender->name = $name;
        $gender->save();
        $this->info('Género creado correctamente con id ' . $gender->id );
    }
    public function update()
    {
        $id = $this->argument('id');

        $gender = ModelsGenders::find($id);

        if (!$gender) {
            $this->error('Género no encontrado');
            return;
        }

        $this->info('Actualizar género');

        $this->info("Información actual del género:");
        $this->info("Nombre: {$gender->name}");

        $name = $this->ask('Nuevo Nombre (o presiona Enter para dejarlo igual)', $gender->name);
        if (!empty($name)) {
            $gender->name = $name;
        }

        $gender->save();

        $this->info('Género actualizado correctamente');
    }
    public function delete()
    {
        $id = $this->argument('id');

        if (!$id) {
            $id = $this->ask('Ingrese el ID del género que desea eliminar:');
        }

        $book = ModelsGenders::find($id);

        if (!$book) {
            $this->error('Género no encontrado. No se ha realizado ninguna eliminación.');
            return;
        }

        $confirmation = $this->confirm("¿Estás seguro de que deseas eliminar el género con ID $id?");

        if ($confirmation) {
            $book->update(['active' => 0]);
            $this->info("Género con ID $id eliminado correctamente.");
        } else {
            $this->info("Eliminación cancelada. El género no ha sido eliminado.");
        }
    }
}
