<?php

namespace App\Http\Controllers\Api\Linkedin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\LinkedinProfile; // Assuming you have a model named LinkedinProfile
use League\ISO3166\ISO3166;

class LinkedinSearchesSaveController extends Controller
{
    private $iso3166;

    public function __construct()
    {
        // Initializes the ISO3166 instance for country code conversion
        $this->iso3166 = new ISO3166();
    }

    /**
     * Store LinkedIn profiles data from search results into the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data for an array of profiles
            $validatedData = $request->validate([
                '*.img' => 'required|string',
                '*.title' => 'required|string',
                '*.url' => 'required|url|max:255',
                '*.snippet' => 'required|string',
            ]);

            if (empty($validatedData)) {
                return response()->json([
                    'message' => 'The given data was empty.',
                    'errors' => 'No profile data provided.',
                    'status' => false
                ], 400);
            }

            // Loop through each profile data and create or update the profile
            foreach ($validatedData as $profileData) {
                $username = $this->extractUsername($profileData['url']);
                $nameGet = $this->extractName($profileData['title']);
                $fullName = $nameGet['first_name'] . ' ' . $nameGet['last_name'];
                $countryCode = $this->extractCountryCode($profileData['url']);
                $countryName = $this->getCountryName($countryCode);
                $linkedinUrl = $this->getLinkedInProfileUrl($profileData['url']);
                
                // Check if profile already exists based on username or public_identifier
                $profile = LinkedinProfile::where('username', $username)
                    ->orWhere('public_identifier', $username)
                    ->first();

                if (!$profile) {
                    // Insert new profile if not existing
                    LinkedinProfile::create([
                        'username'           => $username,
                        'public_identifier'  => $username,
                        'linkedin_url'       => $linkedinUrl,
                        'first_name'         => $nameGet['first_name'],
                        'last_name'          => $nameGet['last_name'],
                        'full_name'          => $fullName,
                        'profile_photo'      => $profileData['img'],
                        'headline'           => $profileData['title'],
                        'snippet'            => $profileData['snippet'],
                        'country_code'       => $countryCode,
                        'country'            => $countryName,
                    ]);
                }
            }

            return response()->json(['message' => 'Profiles data stored successfully', 'status' => true], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
                'status' => false
            ], 400);
        }
    }

    /**
     * Extracts the username from the LinkedIn profile URL.
     *
     * @param string $url
     * @return string|null
     */
    private function extractUsername($url)
    {
        $pattern = "/\/in\/([^\/?]+)/";
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Constructs the full LinkedIn profile URL using the username.
     *
     * @param string $url
     * @return string|null
     */
    private function getLinkedInProfileUrl($url)
    {
        $username = $this->extractUsername($url);
        $baseUrl = "https://www.linkedin.com/in/";
        return $username ? $baseUrl . $username : null;
    }

    /**
     * Extracts the name from the profile title.
     *
     * @param string $title
     * @return array
     */
    private function extractName($title)
    {
        $nameArray = explode(' – ', $title);
        if (isset($nameArray[0])) {
            $fullName = trim($nameArray[0]);
            $fullName = preg_replace('/[,\-]/', '', $fullName);
            $nameParts = explode(' ', $fullName);
            return [
                'first_name' => $nameParts[0] ?? null,
                'last_name' => $nameParts[1] ?? null
            ];
        }
        return ['first_name' => null, 'last_name' => null];
    }

    /**
     * Extracts the country code from the LinkedIn profile URL.
     *
     * @param string $url
     * @return string|null
     */
    private function extractCountryCode($url)
    {
        $host = parse_url($url, PHP_URL_HOST);
        $pattern = '/\.(\w{2})\./';
        if (preg_match($pattern, $host, $matches)) {
            return $matches[1];
        }
    
        $subdomainPattern = '/^([^\.]+)\./';
        if (preg_match($subdomainPattern, $host, $subdomainMatches)) {
            return $subdomainMatches[1];
        }
    
        return null;
    }

    /**
     * Get the country name by country code.
     *
     * @param string|null $code The country code.
     * @return string|null The country name if found, null otherwise.
     */
    private function getCountryName($code)
    {
        if (!$code) {
            return null;
        }

        try {
            $country = $this->iso3166->alpha2($code);
            return $country['name'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}