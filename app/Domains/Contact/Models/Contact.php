<?php

namespace App\Domains\Contact\Models;

use App\Domains\Contact\Factories\ContactFactory;
use App\Domains\Contact\Interfaces\ContactInterface;
use App\Domains\User\Models\User;
use App\Infrastructure\Base\Interfaces\FactoryInterface;
use App\Infrastructure\Base\Models\BaseModel;
use App\Infrastructure\Common\Traits\FilterableTrait;
use App\Infrastructure\Common\Traits\RUIDTrait;
use App\Infrastructure\Common\Traits\SearchableTrait;
use App\Infrastructure\Common\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends BaseModel implements ContactInterface
{
    use SoftDeletes;
    use HasFactory;
    use RUIDTrait;
    use SortableTrait;
    use SearchableTrait;
    use FilterableTrait;

    public const RUID_PREFIX = 'CO';

    public const SORTABLE_COLUMNS = [
        'firstname',
        'lastname',
        'email_address',
    ];

    public const SEARCHABLE_COLUMNS = [
        'firstname',
        'lastname',
        'email_address',
    ];

    public const FILTERABLE_COLUMNS = [
        'email_address',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'contact_no',
        'email_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function login(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get a new contact factory instance.
     *
     * @return FactoryInterface|null
     */
    protected static function newFactory(): ?FactoryInterface
    {
        return ContactFactory::new();
    }
}
