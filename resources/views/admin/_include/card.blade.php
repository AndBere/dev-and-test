<div class="content-wrapper mt-2">
    <section class="content">
        <div class="row" id="editor">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        {{ $create ?? '' }}

                        {{ $cardTitle ?? ''}}
                        <div class="card-tools">
                            {{ $cardFilters }}
                            @include('admin._include._card_tools')
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $cardBody }}
                    </div>
                    @isset($cardFooter)
                        <div class="card-footer">
                            {{ $cardFooter }}
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </section>
</div>
