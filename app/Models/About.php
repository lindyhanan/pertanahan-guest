<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
     Schema::create('abouts', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->text('content')->nullable();
        $table->timestamps();
    });
}
