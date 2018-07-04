<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

trait GetTemporaryUrl{

	public function temporaryUrl($do_path, $expires = null)
    {
        $expires = $expires ?? Carbon::now()->addMinutes(2);
        $config = config('filesystems.disks')['spaces'];
        $request = "GET\n\n\n{$expires->timestamp}\n/{$config['bucket']}/{$do_path}";
        $signature = urlencode(base64_encode(hash_hmac('sha1', $request, $config['secret'], true)));
        return "{$config['endpoint']}{$config['bucket']}/{$do_path}?AWSAccessKeyId={$config['key']}&Expires={$expires->timestamp}&Signature={$signature}";
    }
}
