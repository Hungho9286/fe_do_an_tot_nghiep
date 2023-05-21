<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhongHoc;
use App\Models\LopHocPhan;
class ThoiKhoaBieu extends Model
{
    use HasFactory;

    public function lopHocPhan(){
        return $this->belongsTo(LopHocPhan::class,'id_lop_hoc_phan','id');
    }
}
