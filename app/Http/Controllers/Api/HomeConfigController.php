<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSetting;
use App\Models\WelcomeFeature;
use App\Models\HeroCard;
use App\Models\SocialWidget;
use App\Models\BenefitItem;
use App\Models\VisionPoint;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Kejuruan;
use App\Models\ModalSlider;
use App\Models\Profile;
use App\Models\HeroProfile;
use App\Models\News;

class HomeConfigController extends Controller
{
    /**
     * Get all Home Configuration data in one shot.
     */
    public function index()
    {
        // Fetch Settings as Key-Value pair
        $settings = HomeSetting::pluck('value', 'key');

        // Fetch Lists
        $welcomeFeatures = WelcomeFeature::where('is_active', true)->orderBy('order')->get();
        $heroCards = HeroCard::with('image')->orderBy('order')->get();
        $socialWidgets = SocialWidget::where('is_active', true)->orderBy('order')->get();
        $benefitItems = BenefitItem::where('is_active', true)->orderBy('order')->get();
        $visionPoints = VisionPoint::where('is_active', true)->orderBy('order')->get();

        // Fetch Additional Home Data (Sliders, Galleries, Kejuruan)
        $sliders = Slider::where('is_active', true)->with('image')->get();
        $modalSliders = ModalSlider::where('is_active', true)->with('image')->orderBy('order')->get();
        $galleries = Gallery::latest()->limit(12)->with('media')->get();
        $departments = Kejuruan::with('media')->get();

        // Fetch School Profiles (Sejarah, Identitas, BMW) for consistency
        $schoolProfiles = Profile::whereIn('type', ['sejarah', 'profil', 'bmw'])->with('media')->get();
        // Fetch active Hero Profile
        // Fetch active Hero Profile and Transform
        $heroProfileModel = HeroProfile::where('is_active', true)->with('media')->first();
        $heroProfile = null;
        if ($heroProfileModel) {
            $url = null;
            if ($heroProfileModel->media->isNotEmpty()) {
                $media = $heroProfileModel->media->first();
                $url = $media->url;
                if (!$url && $media->file_path) {
                    $url = asset('storage/' . $media->file_path);
                }
                // Fix double prefix if handled elsewhere
                if ($media->file_path && (\Illuminate\Support\Str::startsWith($media->file_path, 'http'))) {
                    $url = $media->file_path;
                }
            }
            $heroProfile = [
                'id' => $heroProfileModel->id,
                'title' => $heroProfileModel->title,
                'is_active' => $heroProfileModel->is_active,
                'url' => $url
            ];
        }

        // Fetch News / Agenda for Ticker
        $news = News::where('status', 'published')->orderByRaw('event_date DESC, created_at DESC')->limit(5)->with('media')->get();

        return response()->json([
            'settings' => $settings,
            'welcome_features' => $welcomeFeatures,
            'hero_cards' => $heroCards,
            'social_widgets' => $socialWidgets,
            'benefit_items' => $benefitItems,
            'vision_points' => $visionPoints,
            'sliders' => $sliders,
            'modal_sliders' => $modalSliders,
            'galleries' => $galleries,
            'departments' => $departments,
            'school_profiles' => $schoolProfiles,
            'hero_profile' => $heroProfile,
            'news' => $news,
        ]);
    }

    public function getTypes()
    {
        return response()->json([
            'available_sections' => [
                'settings',
                'welcome_features',
                'hero_cards',
                'social_widgets',
                'benefit_items',
                'vision_points',
                'vision_points',
                'sliders',
                'modal_sliders',
                'galleries',
                'departments'
            ]
        ]);
    }

    public function getSection($section)
    {
        switch ($section) {
            case 'settings':
                return response()->json(HomeSetting::pluck('value', 'key'));
            case 'welcome_features':
                return response()->json(WelcomeFeature::where('is_active', true)->orderBy('order')->get());
            case 'hero_cards':
                return response()->json(HeroCard::with('image')->orderBy('order')->get());
            case 'social_widgets':
                return response()->json(SocialWidget::where('is_active', true)->orderBy('order')->get());
            case 'benefit_items':
                return response()->json(BenefitItem::where('is_active', true)->orderBy('order')->get());
            case 'vision_points':
                return response()->json(VisionPoint::where('is_active', true)->orderBy('order')->get());
            case 'sliders':
                return response()->json(Slider::where('is_active', true)->with('image')->get());
            case 'modal_sliders':
                return response()->json(ModalSlider::where('is_active', true)->with('image')->orderBy('order')->get());
            case 'galleries':
                return response()->json(Gallery::latest()->limit(12)->with('media')->get());
            case 'departments':
                return response()->json(Kejuruan::with('media')->get());
            case 'hero_profile':
                return response()->json(HeroProfile::where('is_active', true)->with('media')->first());
            default:
                return response()->json(['message' => 'Section not found'], 404);
        }
    }
}
