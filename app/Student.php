<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function path()
    {
        return 'students/'.$this->id;
    }

    public function enrolled($group)
    {
        $enrollment = $this->enrollments()->where('group_id', $group->id)
            ->where('student_id', $this->id)
            ->where('hs_date', now())
            ->where('hs_day', now()->localeDayOfWeek)
            ->first();

        if(is_null($enrollment)){
            $this->enrollments()->create([
                'hs_date'=>now(),
                'hs_day'=> now()->localeDayOfWeek,
                'group_id'=>$group->id,
            ]);
        }else{
            throw new \Exception('Nije moguće upisati istog studenta dva puta u isti termin!!');
        }
    }

    public function enrollments()
    {
        return $this->hasMany(HourHeld::class);
    }

    public function recorded($ayear)
    {
       $recording = $this->records()->where('ayear_id', $ayear->id)
            ->where('student_id', $this->id)
            ->first();

       if(is_null($recording)){
            $this->records()->create([
                'ayear_id'=>$ayear->id,
                'student_id'=> $this->id,
                'excuse_id'=>null,
                'nof_excused_weeks'=>0,
                'group_id'=>null,
                'sumS1'=>0,
                'satisfiedS1'=>false,
                'sumS2'=>0,
                'satisfiedS2'=>false,
                'evidence_comment'=>null,
                'yearOFstudy'=>1,
                'repeater'=>false,
            ]);
       }else{
             throw new \Exception('Nije moguće upisati istog studenta dva puta u istu akademsku godinu!!');
       }
    }

    public function records()
    {
        return $this->hasMany(TZKrecord::class);
    }
}