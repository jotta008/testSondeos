<?php

namespace App\Console\Commands;

use App\Models\Books as ModelsBooks;
use App\Models\Genders;
use Illuminate\Console\Command;

class Books extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:commands {action?} {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtener todos los libros';

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
        $this->info('Libros');
        $headers = ['Id', 'ISBN', 'Título', 'Autor', 'Precio', 'Fecha de publicación', 'Género'];

        
        $books = ModelsBooks::where('active', 1)
        ->get(['id', 'isbn', 'title', 'author', 'price', 'publication_date', 'gender_id'])
        ->toArray();
        $this->table($headers, $books);
    }
    public function getById()
    {
        $id = $this->argument('id');

        $book = ModelsBooks::find($id);
        if (!$book) {
            $this->error('El libro con el ID especificado no existe.');
            return;
        }
        $book = $book->toArray();
        $columnas = ['id', 'isbn', 'title', 'author', 'price', 'publication_date', 'gender_id'];
        $book = array_intersect_key($book, array_flip($columnas));
        $headers = ['Id', 'ISBN', 'Título', 'Autor', 'Precio', 'Fecha de publicación', 'Género'];
        $this->table($headers, [$book]);
    }
    public function create()
    {
        $this->info('Crear libro');

        $isbn = '';
        $title = '';
        $author = '';
        $price = '';
        $publication_date = '';
        $gender_id = '';

        while (empty($isbn)) {
            $isbn = $this->ask('ISBN');
            if (empty($isbn)) {
                $this->error('El ISBN no puede estar vacío');
            }
            if (ModelsBooks::where('isbn', $isbn)->exists()) {
                $this->error('El ISBN ya existe');
                $isbn = '';
            }
        }


        while (empty($title)) {
            $title = $this->ask('Título');
            if (empty($title)) {
                $this->error('El título no puede estar vacío');
            }
        }

        while (empty($author)) {
            $author = $this->ask('Autor');
            if (empty($author)) {
                $this->error('El autor no puede estar vacío');
            }
        }

        while (empty($price) || !is_numeric($price)) {
            $price = $this->ask('Precio (Usa dos decimales)');
            if (empty($price)) {
                $this->error('El precio no puede estar vacío');
            } elseif (!is_numeric($price)) {
                $this->error('El precio debe ser un número');
            }
        }

        while (empty($publication_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $publication_date)) {
            $publication_date = $this->ask('Fecha de publicación (Formato: YYYY-MM-DD)');
            if (empty($publication_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $publication_date)) {
                $this->error('La fecha de publicación debe tener el formato correcto (YYYY-MM-DD)');
            }
        }

        while (empty($gender_id)) {
            $gender_id = $this->ask('Género');
            if (empty($gender_id)) {
                $this->error('El género no puede estar vacío');
            }
            if (!Genders::where('id', $gender_id)->exists()) {
                $this->error('El género no existe');
                $gender_id = '';
            }
        }

        $book = new ModelsBooks();
        $book->isbn = $isbn;
        $book->title = $title;
        $book->author = $author;
        $book->price = $price;
        $book->publication_date = $publication_date;
        $book->gender_id = $gender_id;
        $book->save();
        $this->info('Libro creado correctamente');
    }
    public function update()
    {
        $id = $this->argument('id');

        $book = ModelsBooks::find($id);

        if (!$book) {
            $this->error('Libro no encontrado');
            return;
        }

        $this->info('Actualizar libro');

        $this->info("Información actual del libro:");
        $this->info("ISBN: {$book->isbn}");
        $this->info("Título: {$book->title}");
        $this->info("Autor: {$book->author}");
        $this->info("Precio: {$book->price}");
        $this->info("Fecha de publicación: {$book->publication_date}");
        $this->info("Género: {$book->gender_id}");

        $isbn = $this->ask('Nuevo ISBN (o presiona Enter para dejarlo igual)', $book->isbn);
        $title = $this->ask('Nuevo Título (o presiona Enter para dejarlo igual)', $book->title);
        $author = $this->ask('Nuevo Autor (o presiona Enter para dejarlo igual)', $book->author);
        $price = $this->ask('Nuevo Precio (Usa dos decimales) (o presiona Enter para dejarlo igual)', $book->price);
        $publication_date = $this->ask('Nueva Fecha de publicación (Formato: YYYY-MM-DD) (o presiona Enter para dejarlo igual)', $book->publication_date);
        $gender_id = $this->ask('Nuevo Género (o presiona Enter para dejarlo igual)', $book->gender_id);

        if (!empty($isbn)) {
            $book->isbn = $isbn;
        }

        if (!empty($title)) {
            $book->title = $title;
        }

        if (!empty($author)) {
            $book->author = $author;
        }

        if (!empty($price)) {
            if (is_numeric($price)) {
                $book->price = $price;
            } else {
                $this->error('El precio debe ser un número válido. El libro no se ha actualizado.');
                return;
            }
        }

        if (!empty($publication_date) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $publication_date)) {
            $book->publication_date = $publication_date;
        } elseif (!empty($publication_date)) {
            $this->error('La fecha de publicación debe tener el formato correcto (YYYY-MM-DD). El libro no se ha actualizado.');
            return;
        }

        if (!empty($gender_id)) {
            if (Genders::where('id', $gender_id)->exists()) {
                $book->gender_id = $gender_id;
            } else {
                $this->error('El género no existe. El libro no se ha actualizado.');
                return;
            }
        }

        $book->save();

        $this->info('Libro actualizado correctamente');
    }
    public function delete()
    {
        $id = $this->argument('id');

        if (!$id) {
            $id = $this->ask('Ingrese el ID del libro que desea eliminar:');
        }

        $book = ModelsBooks::find($id);

        if (!$book) {
            $this->error('Libro no encontrado. No se ha realizado ninguna eliminación.');
            return;
        }

        $confirmation = $this->confirm("¿Estás seguro de que deseas eliminar el libro con ID $id?");

        if ($confirmation) {
            $book->update(['active' => 0]);
            $this->info("Libro con ID $id eliminado correctamente.");
        } else {
            $this->info("Eliminación cancelada. El libro no ha sido eliminado.");
        }
    }
}
