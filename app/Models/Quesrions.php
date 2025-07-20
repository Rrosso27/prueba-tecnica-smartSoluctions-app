<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Quesrions
 *
 * @property int $id
 * @property int $user_id
 * @property string $question_text
 * @property string $question_type
 * @property array|null $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Quesrions extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question_text',
        'question_type',
        'options',
    ];
    /**
     * Get the user that owns the question.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
