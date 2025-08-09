<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Node;

class NodeController extends Controller
{
    public function index(Request $request)
    {
        $query = Node::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($country = $request->input('country')) {
            $query->whereJsonContains('countries', $country);
        }

        if ($industry = $request->input('industry')) {
            $query->whereJsonContains('industries', $industry);
        }

        $nodes = $query->orderBy('name')->paginate(10)->withQueryString();

        // Optional: extract unique filters from all nodes
        $allCountries = Node::pluck('countries')->flatten()->unique()->sort()->values();
        $allIndustries = Node::pluck('industries')->flatten()->unique()->sort()->values();

        return view('nodes.index', compact('nodes', 'allCountries', 'allIndustries'));
    }
}
