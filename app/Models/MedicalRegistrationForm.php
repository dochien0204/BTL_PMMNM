<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRegistrationForm extends Model {

    use HasFactory;
    protected $table = 'medical_registration_form';
    protected $guarded = [];
}