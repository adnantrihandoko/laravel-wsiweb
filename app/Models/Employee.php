<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Model
{

    protected $fillable = ['name', 'email', 'position'];
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('position');
            $table->timestamps();
        });
    }
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
