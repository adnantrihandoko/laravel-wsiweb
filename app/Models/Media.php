<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['name', 'path', 'type', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}