<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    //
    protected $table = 'e_recruit.tm_parameters';



    public function scopeReligion()
    {
    	return Parameters::where('kategori','RELIGION')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopeMarital()
    {
    	return Parameters::where('kategori','MARITAL')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    } 

    public function scopeNationality()
    {
    	return Parameters::where('kategori','NATIONALITY')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    } 

    public function scopeStrata()
    {
    	return Parameters::where('kategori','STRATA')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopeSource()
    {
        return Parameters::where('kategori','SOURCE')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }    

    public function scopeStatus()
    {
    	return Parameters::where('kategori','STATUS')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopeResult()
    {
        return Parameters::where('kategori','RESULT')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopeRelationship()
    {
        return Parameters::where('kategori','RELATIONSHIP')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopeGender()
    {
        return Parameters::where('kategori','GENDER')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopeEducation()
    {
        return Parameters::where('kategori','EDUCATION')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }

    public function scopePublish()
    {
        return Parameters::where('kategori','PUBLISH')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }


    public function scopeActive()
    {
        return Parameters::where('kategori','ACTIVE')->where('status',1)->select('kode','nama','parameter_id')->orderby('nama','asc');
    }



}
