<div class="modal fade" id="employee-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.employee.store') }}" method="post" onsubmit="ajaxStore(event, this, 'post', 'employee-add')" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-check col-sm-3">
                        <label>Login Permission <span class="t_r">*</span></label><br>
                        <label class="form-radio-label" id="permissionYes">
                            <input class="form-radio-input" type="radio" name="" value="1" >
                            <span class="form-radio-sign">Yes</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="" value="0" checked id="permissionNo">
                            <span class="form-radio-sign">No</span>
                        </label>
                    </div>

                    <div class="form-group col-sm-6">
                        <div id="permissionShow">
                            <label for="permission">Permission <span class="t_r">*</span></label>
                            <select name="permission" id="" class="form-control @error('permission') is-invalid @enderror">
                                <option selected >Select</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('permission')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="designation">Designation <span class="t_r">*</span></label>
                        <select name="employee_cat_id" id="designation" class="form-control @error('employee_cat_id') is-invalid @enderror" required>
                            <option value selected disabled>Select Designation </option>
                            @foreach ($employeeCats as $employeeCat)
                            <option value="{{$employeeCat->id}}">{{$employeeCat->name}}</option>
                            @endforeach
                        </select>
                        @error('employee_cat_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="job_loc">Job Location</label>
                        <input type="text" name="job_loc" class="form-control @error('job_loc') is-invalid @enderror" value="{{old('job_loc')}}">
                        @error('job_loc')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tmm_so_id">Employee Id</label>
                        <input type="text" name="tmm_so_id" class="form-control @error('tmm_so_id') is-invalid @enderror" value="{{old('tmm_so_id')}}" placeholder="Enter Employee Id">
                        @error('tmm_so_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="name">Employee Name <span class="t_r">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Enter Employee Name" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="f_name">Father Name <span class="t_r">*</span></label>
                        <input type="text" name="f_name" class="form-control @error('f_name') is-invalid @enderror" value="{{old('f_name')}}" placeholder="Enter Father Name" required>
                        @error('f_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="m_name">Mother Name <span class="t_r">*</span></label>
                        <input type="text" name="m_name" class="form-control @error('m_name') is-invalid @enderror" value="{{old('m_name')}}" placeholder="Enter Mother Name" required>
                        @error('m_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="d_o_b">Date of Birth <span class="t_r">*</span></label>
                        <input type="date" name="d_o_b" class="form-control @error('d_o_b') is-invalid @enderror" value="{{old('d_o_b')}}" placeholder="Enter Date of Birth" required>
                        @error('d_o_b')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="nid">NID <span class="t_r">*</span></label>
                        <input type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" value="{{old('nid')}}" placeholder="Enter NID" onInput="this.value = this.value.replace(/[^\d]/g,'');"  required>
                        @error('nid')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="phone">Personal Phone <span class="t_r">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" placeholder="Enter Phone" onInput="this.value = this.value.replace(/[^\d\+\-]/g,'');"  required>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="blood">Blood Group </label>
                        <input type="text" name="blood" class="form-control @error('blood') is-invalid @enderror" value="{{old('blood')}}" placeholder="Enter Blood Group">
                        @error('blood')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check col-sm-6">
                        <label>Marital Status <span class="t_r">*</span></label><br>
                        <select name="m_status" class="form-control @error('phone') is-invalid @enderror">
                            <option selected disabled value >Select</option>
                            <option value="1" >Married</option>
                            <option value="2" >Unmarried</option>
                        </select>
                        @error('m_status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="email">Email <span class="t_r">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Enter Email" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="c_phone">Company Phone </label>
                        <input type="text" name="c_phone" class="form-control @error('c_phone') is-invalid @enderror" value="{{old('c_phone')}}" placeholder="Enter Company Phone" onInput="this.value = this.value.replace(/[^\d\+\-]/g,'');" >
                        @error('c_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="j_date">Joining Date <span class="t_r">*</span></label>
                        <input type="date" name="j_date" class="form-control @error('j_date') is-invalid @enderror" value="{{old('j_date')}}" placeholder="Enter Joining Date" required>
                        @error('j_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Password <span class="t_r">*</span></label>
                        <input name="password" type="password" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Confirm Password <span class="t_r">*</span></label>
                        <input name="password_confirmation" type="password" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <hr class="bg-warning">
                {{-- _________________________ Salary Info_________________________ --}}
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="basic_pay">Basic Pay</label>
                        <input type="number" name="basic_pay" class="form-control totalAmt @error('basic_pay') is-invalid @enderror" value="{{old('basic_pay')}}">
                        @error('basic_pay')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="house_rent">House Rent</label>
                        <input type="number" name="house_rent" class="form-control totalAmt @error('house_rent') is-invalid @enderror" value="{{old('house_rent')}}">
                        @error('house_rent')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="medical_a">House Rent</label>
                        <input type="number" name="medical_a" class="form-control totalAmt @error('medical_a') is-invalid @enderror" value="{{old('medical_a')}}">
                        @error('medical_a')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="bonus">Bonus</label>
                        <input type="number" name="bonus" class="form-control totalAmt @error('bonus') is-invalid @enderror" value="{{old('bonus')}}">
                        @error('bonus')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="form-group col-sm-4">
                        <label for="total">Total Amount</label>
                        <input type="number" name="total" id="total" class="form-control @error('total') is-invalid @enderror" readonly>
                        @error('total')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr class="bg-warning">
                {{-- _________________________ Nominee Info_________________________ --}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="g_name">Guarantor Name</label>
                        <input type="text" name="g_name" class="form-control @error('g_name') is-invalid @enderror" value="{{old('g_name')}}" placeholder="Enter Guarantor Name">
                        @error('g_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="g_phone">Guarantor Phone</label>
                        <input type="number" name="g_phone" class="form-control @error('g_phone') is-invalid @enderror" value="{{old('g_phone')}}" placeholder="Enter Guarantor Phone" onInput="this.value = this.value.replace(/[^\d\+\-]/g,'');" >
                        @error('g_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="relation">Relation</label>
                        <input type="text" name="relation" class="form-control @error('relation') is-invalid @enderror" value="{{old('relation')}}" placeholder="Enter Relation">
                        @error('relation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="bg-warning">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="address">Mailing Address <span class="t_r">*</span></label>
                        <textarea name="address" id="" cols="15" rows="6" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" placeholder="Enter Mailing Address" required></textarea>
                        {{-- <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" placeholder="Enter Address" required> --}}
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="address">Permanent Address <span class="t_r">*</span></label>
                        <textarea name="p_address" id="" cols="15" rows="6" class="form-control @error('p_address') is-invalid @enderror" value="{{old('p_address')}}" placeholder="Enter Permanent Address" required></textarea>
                        {{-- <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" placeholder="Enter Address" required> --}}
                        @error('p_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                    <hr class="bg-warning">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="image" class="placeholder">Photo</label>
                            <input id="image" name="image" type="file" class="form-control">
                        </div>
                    </div>


                    {{-- File --}}
                    <div class="row col-md-12"><h3 style="margin-left: 8px; font-weight:bold">Documents</h3></div>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:250px">File</th>
                            <th>Note</th>
                            <th style="width: 20px;text-align:center;">
                                <span class="btn btn-info btn-sm" style="padding: 4px 13px"><i class="fas fa-mouse"></i></span>
                            </th>
                        </tr>

                        <tr>
                            <td><input type="file" name="document[]" multiple id="document_1" class="form-control form-control-sm" style="width:250px"/></td>
                            <td><input type="text" name="note[]"          id="qty_1"           class="form-control form-control-sm" placeholder="Note"/></td>
                            <td style="width: 20px"><span class="btn btn-sm btn-success addrow"><i class="fa fa-plus" aria-hidden="true"></i></span></td>
                        </tr>
                        <tbody id="showItem"></tbody>
                    </table>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
        </form>
      </div>
    </div>
  </div>



<script>
    $('#permissionYes').click(function(){
        $('#permissionShow').show()
    })
    $('#permissionNo').click(function(){
        $('#permissionShow').hide()
    })
</script>
<script>
    $('.totalAmt').keyup(function() {
        var total = 0;
        var basic_pay = $("[name='basic_pay']").val()
        var house_rent = $("[name='house_rent']").val()
        var medical_a = $("[name='medical_a']").val()
        var bonus = $("[name='bonus']").val()

        $('.totalAmt').each(function() {
            total = Number(basic_pay) + Number(house_rent) + Number(medical_a) + Number(bonus);
        });
        $('#total').val(total);
    });
</script>
<script>
	$(document).ready(function(){
		var i = 1;
		$('.addrow').click(function()
			{i++;
				html ='';
				html +='<tr id="remove_'+i+'" class="post_item">';
	            html +='    <td><input type="file" name="name[]" multiple id="document_1" class="form-control form-control-sm" style="width:200px"/></td>';
	            html +='	<td><input type="text" name="note[]"          id="qty_1"           class="form-control form-control-sm" placeholder="Note"/></td>';
	            html +='	<td style="width: 20px"  class="col-md-2"><span class="btn btn-sm btn-danger" onclick="return remove('+i+')"><i class="fa fa-times" aria-hidden="true"></i></span></td>';
	            html +='</tr>';
	            $('#showItem').append(html);
			});
	});
	function remove(id)
	{
		$('#remove_'+id).remove();
		total_price();
    }
</script>


