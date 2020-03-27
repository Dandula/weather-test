@extends('layouts.app')

@section('content')
<div class="container">
    @if ($reviews->count())
        <div class="row mb-4">
            <div class="card-deck">
                @foreach ($reviews as $review)
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="card-text blockquote">
                                <p class="mb-0"><?php echo $review->content; ?></p>
                                <footer class="blockquote-footer">
                                    <small>
                                        <em><?php echo $review->name; ?></em>,
                                        <a href="mailto:<?php echo $review->email; ?>"><?php echo $review->email; ?></a>
                                    </small>
                                </footer>
                            </blockquote>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{ __('Created at :created_at', ['created_at' => $review->created_at]) }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <?php echo $reviews->render(); ?>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <p class="lead text-center">
                    {{ __('No reviews...') }}
                </p>
            </div>
        </div>
    @endif
</div>
@endsection
