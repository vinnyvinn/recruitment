<?php

namespace Boaz\Http\Controllers\Api;

use Boaz\Repositories\Country\CountryRepository;
use Boaz\Transformers\CountryTransformer;

/**
 * Class CountriesController
 * @package Boaz\Http\Controllers\Api
 */
class CountriesController extends ApiController
{
    /**
     * @var CountryRepository
     */
    private $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->middleware('auth');
        $this->countries = $countries;
    }

    /**
     * Get list of all available countries.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithCollection(
            $this->countries->all(),
            new CountryTransformer
        );
    }
}
