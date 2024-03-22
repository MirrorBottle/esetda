<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Banner;

class SettingController extends Controller
{
    public function banner()
    {
        $banners = Banner::all();

        return view('admin.settings.banner', compact('banners'));
    }

    public function bannerUpdate(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        if ( $request->has('status') ) {
            $banner->update(['is_active' => $request->status]);
            return back()->with('success', 'Berhasil mengubah status banner');
        }

        if ( $request->hasFile('banner') ) {
            $file_ext   = $request->banner->getClientOriginalExtension();
            $file_name  = "banner_" . $id."_". time() .".". $file_ext;

            $request->banner->move(
                public_path('images/sliders'),
                $file_name
            );

            unlink( public_path('images/sliders/' . $banner->file_name) );

            $banner->update(['file_name' => $file_name]);

            return back()->with('success', 'Berhasil mengubah foto banner');
        }

        return null;
    }

    public function index()
    {
        $settings = Setting::all();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $post = $request->except(['_token', '_method']);

        foreach ($post as $name => $value) {
            Setting::where('name', $name)->update([
                'value' => $value
            ]);
        }

        return back()->with('success', 'Berhasil mengubah pengaturan aplikasi');
    }
}
