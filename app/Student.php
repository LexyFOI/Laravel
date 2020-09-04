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
    //public function enrolled($user)
    {
        $enrollment = $this->enrollments()->where('group_id', $group->id)
        //$enrollment = $this->enrollments()->where('group_id', $user->group_id)
            ->where('student_id', $this->id)
            ->where('hs_date', now())
            ->where('hs_day', now()->localeDayOfWeek)
            ->first();

        if(is_null($enrollment)){
            $this->enrollments()->create([
                'hs_date'=>now(),
                'hs_day'=> now()->localeDayOfWeek,
                'group_id'=>$group->id,
                //'group_id'=>$user->group_id,
            ]);
           // dd($this->enrollments()->first());
        }else{
            throw new \Exception('Nije moguće upisati istog studenta dva puta u isti termin!!');
        }
    }

    public function enrollments()
    {
        return $this->hasMany(HourHeld::class);
    }
}
