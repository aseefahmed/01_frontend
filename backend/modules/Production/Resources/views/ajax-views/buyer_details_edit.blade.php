<div class="row">
    <div class="col-sm-12">
        <form id="update-buyer-form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $buyer->id }}">
            <div class="formSep">
                <div class="row">
                    <div class="col-sm-12">
                        <code>Buyer Name </code>
                        <div class="row">
                            &nbsp;&nbsp;
                        </div>
                        <input class="form-control" placeholder="Buyer Name" value="{{ $buyer->buyer_name }}" type="text" name="buyer_name" id="buyer_name" />
                    </div>
                </div>
            </div>
            <div class="formSep">
                <div class="row">
                    <div class="col-sm-12">
                        <code>Image </code>
                        <div class="row">
                            &nbsp;&nbsp;
                        </div>
                        <img src="{{ asset('img/uploads/production/buyers/'.$buyer->image) }}" width="100%" height="100%">

                        <input id="buyer_image" name="buyer_image" type="file" class="file file-upload" data-preview-file-type="text" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>