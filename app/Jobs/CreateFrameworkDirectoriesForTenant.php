<?php

namespace App\Jobs;

use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateFrameworkDirectoriesForTenant implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function handle()
    {
            $this->tenant->run(function ($tenant) {
                $storage_path = storage_path();
    
                $suffixBase = config('tenancy.filesystem.suffix_base');
    
                if (!is_dir(public_path($suffixBase))) {
                    @mkdir(public_path($suffixBase), 0777, true);
                }
    
                if (!is_dir($storage_path)) {
                    @mkdir("{$storage_path}/app/public", 0777, true);
                    @mkdir("{$storage_path}/framework/cache", 0777, true);
    
                    symlink("{$storage_path}/app/public", public_path("{$suffixBase}{$tenant->id}"));
                }
            });
        }
}