<?= $this->extend('adm/main'); ?>
<?= $this->section('content'); ?>
  
  <div class="row">
     <div class="col-md-8">
          <div class="card">
             <div class="card-header">List of Releases</div>
             <div class="card-body">
                <table class="table table-hover" id="releases-table">
                    <thead>
                         <th>#</th>
                         <th>Release Name</th>
                         <th>Description</th>
                         <th>Actions</th>
                    </thead>
                    <tbody></tbody>
                </table>
             </div>
          </div>
     </div>
     <div class="col-md-4">
          <div class="card">
              <div class="card-header">Add new Release</div>
              <div class="card-body">
                  <form action="<?= route_to('add.release'); ?>" method="post" id="add-release-form" autocomplete="off">
                  <?= csrf_field(); ?>
                      <div class="form-group">
                         <label for="">Release subject</label>
                         <input type="text" class="form-control" name="release_subject" placeholder="Enter release subject">
                         <span class="text-danger error-text release_subject_error"></span>
                      </div>
                      <div class="form-group">
                         <label for="">Description</label>
                         <input type="text" class="form-control" name="release_description" placeholder="Enter description release">
                         <span class="text-danger error-text release_description_error"></span>
                      </div>
                      <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">Save</button>
                      </div>
                  </form>
              </div>
          </div>
     </div>
  </div>

<?= $this->include('adm/module_release/editReleaseModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
 <script>
/*
 var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
 var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH
 */
   //ADD NEW COUNTRY
   $('#add-release-form').submit(function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
           url:$(form).attr('action'),
           method:$(form).attr('method'),
           data:new FormData(form),
           processData:false,
           dataType:'json',
           contentType:false,
           beforeSend:function(){
              $(form).find('span.error-text').text('');
           },
           success:function(data){
                 if($.isEmptyObject(data.error)){
                     if(data.code == 1){
                         $(form)[0].reset();
                         $('#releases-table').DataTable().ajax.reload(null, false);
                     }else{
                         alert(data.msg);
                     }
                 }else{
                     $.each(data.error, function(prefix, val){
                         $(form).find('span.'+prefix+'_error').text(val);
                     });
                 }
           }
        });
   });


   $('#releases-table').DataTable({
       "processing":true,
       "serverSide":true,
       "ajax":"<?= route_to('get.all.releases'); ?>",
       "dom":"lBfrtip",
       stateSave:true,
       info:true,
       "iDisplayLength":5,
       "pageLength":5,
       "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
       "fnCreatedRow": function(row, data, index){
           $('td',row).eq(0).html(index+1);
       }
   });


   $(document).on('click','#updateCountryBtn', function(){
       var country_id = $(this).data('id');
        
        $.post("<?= route_to('get.country.info') ?>",{country_id:country_id, [csrfName]:csrfHash}, function(data){
            //   alert(data.results.country_name);

            $('.editCountry').find('form').find('input[name="cid"]').val(data.results.id);
            $('.editCountry').find('form').find('input[name="country_name"]').val(data.results.country_name);
            $('.editCountry').find('form').find('input[name="capital_city"]').val(data.results.capital_city);
            $('.editCountry').find('form').find('span.error-text').text('');
            $('.editCountry').modal('show');
        },'json');

    
   });

   $('#update-country-form').submit(function(e){
       e.preventDefault();
       var form = this;

       $.ajax({
           url: $(form).attr('action'),
           method:$(form).attr('method'),
           data: new FormData(form),
           processData: false,
           dataType:'json',
           contentType:false,
           beforeSend:function(){
               $(form).find('span.error-text').text('');
           },
           success:function(data){

               if($.isEmptyObject(data.error)){

                   if(data.code == 1){
                    $('#countries-table').DataTable().ajax.reload(null, false);
                     $('.editCountry').modal('hide');
                   }else{
                       alert(data.msg);
                   }

               }else{
                   $.each(data.error, function(prefix, val){
                       $(form).find('span.'+prefix+'_error').text(val);
                   });
               }
           }
       });
   });


   $(document).on('click', '#deleteCountryBtn', function(){
       var country_id = $(this).data('id');
       var url = "<?= route_to('delete.country'); ?>";

       swal.fire({

           title:'Are you sure?',
           html:'You want to delete this country',
           showCloseButton:true,
           showCancelButton:true,
           cancelButtonText:'Cancel',
           confirmButtonText:'Yes, delete',
           cancelButtonColor:'#d33',
           confirmButtonColor:'#556eeb',
           width:300,
           allowOutsideClick:false

       }).then(function(result){
            if(result.value){

                $.post(url,{[csrfName]:csrfHash, country_id:country_id}, function(data){
                     if(data.code == 1){
                        $('#countries-table').DataTable().ajax.reload(null, false);
                     }else{
                         alert(data.msg);
                     }
                },'json');
            }
       });
   });


 </script>

<?= $this->endSection(); ?>