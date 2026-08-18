<?php
namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::created(function ($model) {
            $model->createAuditEntry('INSERT');
        });

        static::updated(function ($model) {
            $model->createAuditEntry('UPDATE', $model->getOriginal(), $model->getDirty());
        });

        static::deleted(function ($model) {
            $model->createAuditEntry('DELETE', $model->getOriginal());
        });
    }

protected function createAuditEntry($action, $old = null, $new = null)
{
    if ($action === 'INSERT') {
        $changed = $this->getDirty();
        $oldValues = [];

        foreach ($changed as $field => $value) {
            // Si es password, no guardamos el valor real
            if ($field === 'ci' || $field === 'cod_gamea') {
                $changed[$field] = 'creado';
            } else {
                $oldValues[$field] = $this->getOriginal($field);
            }
        }
        $old = $oldValues;
        $new = $changed;
    }
    if ($action === 'UPDATE') {
        $changed = $this->getDirty();
        $oldValues = [];

        foreach ($changed as $field => $value) {
            // Si es password, no guardamos el valor real
            if ($field === 'password') {
                $oldValues[$field] = 'cambiado';
                $changed[$field] = 'cambiado';
            } else {
                $oldValues[$field] = $this->getOriginal($field);
            }
        }
        $old = $oldValues;
        $new = $changed;
    }

    Audit::create([
        'table_name' => $this->getTable(),
        'record_id'  => $this->id,
        'action'     => $action,
        'old_values' => $old ? json_encode($old) : null,
        'new_values' => $new ? json_encode($new) : null,
        'user_id'    => Auth::id(),
    ]);
}
}
