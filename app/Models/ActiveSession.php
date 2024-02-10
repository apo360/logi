<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// Dentro do modelo ActiveSession.php
class ActiveSession extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id', 'ip_address', 'user_agent', 'last_activity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Exemplo de método para revogar sessões de outros dispositivos
    public function revokeOtherDevices(User $user, $currentSessionId)
    {
        $user->activeSessions()
            ->where('session_id', '!=', $currentSessionId)
            ->delete();
    }

    // Exemplo de método para encerrar sessões remotamente

    public function logoutFromOtherDevices(User $user, $currentSessionId)
    {
        Auth::logoutOtherDevices($currentSessionId, 'web');

        Auth::guard('web')->logout();
    }


}
