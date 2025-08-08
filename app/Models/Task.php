<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Impor kelas BelongsTo

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', // Ditambahkan: field 'description'
        'due_date',
        'status', // Diubah: 'is_done' menjadi 'status'
        'priority',
        'user_id',
        'assigned_to',
        'attachment',
        'category_id', // Ditambahkan: field 'category_id'
    ];

    /**
     * Relasi: Tugas dimiliki oleh seorang User (pemilik tugas).
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Tugas didelegasikan ke seorang User.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relasi: Tugas memiliki satu Kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
