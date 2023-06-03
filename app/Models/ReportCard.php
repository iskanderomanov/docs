<?php

namespace App\Models;

use App\Http\Enums\StatusTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property array $data
 * @property int $user_id
 * @property int $status
 * @property string $name
 * @property string $created_at
 * @property string $description_answer
 */
class ReportCard extends Model
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const USER_ID = 'user_id';
    public const DATA = 'data';
    public const STATUS = 'status';

    public const NAME = 'name';
    public const DESCRIPTION_ANSWER = 'description_answer';
    /**
     * @var string[]
     */
    protected $fillable = [
        self::USER_ID,
        self::DATA,
        self::STATUS,
        self::NAME,
        self::DESCRIPTION_ANSWER
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::DATA => 'array',
        self::CREATED_AT => 'datetime:Y-m-d'
    ];

    /**
     * @return string
     */
    public function getStatusText():string
    {
        return StatusTypes::getStatusText($this->status);
    }

    /**
     * @return string
     */
    public function getStatusCSSClass(): string
    {
        return StatusTypes::getStatusCSSClass($this->status);
    }
}
