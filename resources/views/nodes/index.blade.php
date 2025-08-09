@extends('layouts.app') {{-- or use html/head manually --}}

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Marketing Solution Providers</h2>

    <form method="GET" action="{{ route('nodes.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name">
        </div>
        <div class="col-md-3">
            <select name="country" class="form-select">
                <option value="">All Countries</option>
                @foreach ($allCountries as $country)
                    <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="industry" class="form-select">
                <option value="">All Industries</option>
                @foreach ($allIndustries as $industry)
                    <option value="{{ $industry }}" {{ request('industry') == $industry ? 'selected' : '' }}>{{ $industry }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Countries</th>
                    <th>Industries</th>
                    <th>Focus Areas</th>
                    <th>Languages</th>
                    <th>Badge</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nodes as $node)
                    <tr>
                        <td>
                            <strong>{{ $node->name }}</strong>
                            @if($node->profile_picture_uri)
                                <br><img src="{{ $node->profile_picture_uri }}" alt="Logo" width="50">
                            @endif
                        </td>
                        <td><a href="{{ $node->company_website }}" target="_blank">{{ $node->company_website }}</a></td>
                        <td>{{ implode(', ', $node->countries ?? []) }}</td>
                        <td>{{ implode(', ', $node->industries ?? []) }}</td>
                        <td>{{ implode(', ', $node->focus_areas ?? []) }}</td>
                        <td>{{ implode(', ', $node->language_tags ?? []) }}</td>
                        <td>{!! $node->is_badged ? '<span class="badge bg-success">Yes</span>' : 'No' !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No nodes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $nodes->links() }}
    </div>
</div>
@endsection
