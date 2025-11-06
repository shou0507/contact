<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGenderLabelAttribute()
    {
        return match ((int)$this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        };
    }

    public function scopeFilter($query, array $params)
    {
        $keyword = $params['keyword'] ?? null;
        $gender = $params['gender'] ?? null;
        $category = $params['category']?? null;
        $date     = $params['date']    ?? null;

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('email', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name',  'like', "%{$keyword}%")
                    ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'like', "%{$keyword}%")
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$keyword}%")
                    ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', "%{$keyword}%");
            });
        }

        if (!empty($gender)) {
            $map = ['male' => 1, 'female' => 2, 'other' => 3];
            if (isset($map[$gender])) {
                $query->where('gender', $map[$gender]);
            }
        }

        if (!empty($category)) {
            $query->where('category_id', (int)$category);
        }

        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
        return $query;
    }
}
