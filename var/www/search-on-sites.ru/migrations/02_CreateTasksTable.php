<?php

use App\Contracts\Migration;

class CreateTasksTable implements Migration
{
    public function up(): void
    {
        // TODO: Implement up() method.
        // create table tasks
        //(
        //	id int,
        //	url varchar(255) not null,
        //	result_json longtext default null null,
        //	result_count int default null null
        //  user_id varchar(30) not null;
        //  type int not null
        //  type_text varchar(255)
        //);
        //
        //create unique index tasks_id_uindex
        //	on tasks (id);
        //
        //alter table tasks
        //	add constraint tasks_pk
        //		primary key (id);
        //
        //alter table tasks modify id int auto_increment;
    }

    public function down(): void
    {
        // TODO: Implement down() method.
    }
}
