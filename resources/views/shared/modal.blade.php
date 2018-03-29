<div class="modal fade shared-modal" id="{{$id}}" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog {{isset($class) ? $class : null}}">
        <div class="modal-content">
            <div class="modal-header bg-{{isset($titleBg) ? $titleBg : null}}">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                </button>
                <h4 class="modal-title">
                    <div class="caption">
                        <span class="caption-subject font-white bold uppercase">
                            <i class="fa fa-cogs"></i>
                            {{$title}}
                        </span>
                    </div>
                </h4>
            </div>
            <div class="modal-container">
                {{isset($container) ? $container : null}}
            </div>
        </div>
    </div>
</div>
</div>