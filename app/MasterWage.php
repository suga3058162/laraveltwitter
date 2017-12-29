<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterWage extends Model
{
    public function getSelectOptions(){
        $datas = MasterWage::all()->toArray();
        $options = [];
        $options[0] = '未選択';
        foreach ($datas as $data) {
            $options[$data['id']] = $data['name'];
        }
        return $options;
    }

    public function getAll(){
        return self::get();
    }

    public function displayMinWage(){
        $displayMinWage = $this->min_wage . '万円';
        return $displayMinWage;
    }

    public function displayMaxWage(){
        if(isset($this->max_wage)) {
        $displayMaxWage = $this->max_wage . '万円';
    } else {
        $displayMaxWage = $this->min_wage . '万円以上';
    }
        return $displayMaxWage;
    }
}
