<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('setting.view')) {
            abort(403, 'Unauthorized action.');
        }


        $settings = Setting::first();


        return view('admin.settings.index',compact('settings'));
    }

    public function updateSetting(Request $request)
    {
        if (!auth()->user()->can('setting.view')) {
            abort(403, 'Unauthorized action.');
        }
        // Validate the input data
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'front_cover_text' => 'required|string|max:500',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
            'favicon_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
            'about_img_one' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
            'about_img_two' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate image if provided
        ]);

        // Retrieve the existing setting record by id
        $setting = Setting::find(1);

        if (!$setting) {
            return redirect()->back()->withErrors(['error' => 'Settings not found.']);
        }

        // Update the basic settings data
        $setting->site_name = $request->site_name;
        $setting->site_email = $request->site_email;
        $setting->phone_number = $request->phone_number;
        $setting->address = $request->address;
        $setting->front_cover_text = $request->front_cover_text;
        $setting->about_sec_title = $request->about_sec_title;
        $setting->about_sec_one = $request->about_sec_one;
        $setting->about_sec_two = $request->about_sec_two;
        $setting->twitter_link = $request->twitter_link;
        $setting->fb_link = $request->fb_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->linkedin_link = $request->linkedin_link;
        $setting->is_active_twitter = $request->is_active_twitter;
        $setting->is_active_fb = $request->is_active_fb;
        $setting->is_active_linkedin = $request->is_active_linkedin;
        $setting->is_active_instagram = $request->is_active_instagram;

        // Handle logo upload if present
        if ($request->hasFile('logo_path')) {
            $logo = $request->file('logo_path');
            $logoName = time() . '_' . $logo->getClientOriginalName();

            // Delete the old logo if it exists
            if ($setting->logo_path && Storage::disk('public')->exists($setting->logo_path)) {
                Storage::disk('public')->delete($setting->logo_path);
            }

            // Store the new logo and update the path in the database
            $logoPath = $logo->storeAs('logos', $logoName, 'public');
            $setting->logo_path = $logoPath;
        }

         // Handle Fav upload if present
         if ($request->hasFile('favicon_path')) {
            $fav = $request->file('favicon_path');
            $favName = time() . '_' . $fav->getClientOriginalName();

            // Delete the old logo if it exists
            if ($setting->favicon_path && Storage::disk('public')->exists($setting->favicon_path)) {
                Storage::disk('public')->delete($setting->favicon_path);
            }

            // Store the new logo and update the path in the database
            $favPath = $fav->storeAs('fav_icon', $favName, 'public');
            $setting->favicon_path = $favPath;
        }


        // Handle Banner upload if present
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannerName = time() . '_' . $banner->getClientOriginalName();

            // Delete the old banner if it exists
            if ($setting->banner && Storage::disk('public')->exists($setting->banner)) {
                Storage::disk('public')->delete($setting->banner);
            }

            // Store the new banner and update the path in the database
            $bannerPath = $banner->storeAs('banners', $bannerName, 'public');
            $setting->banner = $bannerPath;
        }


        // Handle Banner upload if present
        if ($request->hasFile('about_img_one')) {
            $aboutImgOne = $request->file('about_img_one');
            $aboutImgOneName = time() . '_' . $aboutImgOne->getClientOriginalName();

            // Delete the old banner if it exists
            if ($setting->aboutImgOne && Storage::disk('public')->exists($setting->aboutImgOne)) {
                Storage::disk('public')->delete($setting->aboutImgOne);
            }

            // Store the new banner and update the path in the database
            $aboutImgOneNamePath = $aboutImgOne->storeAs('about', $aboutImgOneName, 'public');
            $setting->about_img_one = $aboutImgOneNamePath;
        }


        // Handle About Image Two upload if present
        if ($request->hasFile('about_img_two')) {
            $aboutImgTwo = $request->file('about_img_two');
            $aboutImgTwoName = time() . '_' . $aboutImgTwo->getClientOriginalName();

            // Delete the old image if it exists
            if ($setting->about_img_two && Storage::disk('public')->exists($setting->about_img_two)) {
                Storage::disk('public')->delete($setting->about_img_two);
            }

            // Store the new image and update the path in the database
            $aboutImgTwoNamePath = $aboutImgTwo->storeAs('about', $aboutImgTwoName, 'public');
            $setting->about_img_two = $aboutImgTwoNamePath;
        }


        // Save all updated data
        $setting->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

}
