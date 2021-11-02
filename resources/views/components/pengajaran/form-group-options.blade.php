 <div class="form-group">
     <label for="exampleInputEmail1">JENIS KEGIATAN / MATA KULIAH</label>
     <select class="form-control" name="matkul" id="sel1" required>
         {{-- @forelse($matkul as $item)
             <option value="Laki-Laki">{{ $item->nama_mk }}</option>
         @empty
             <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
         @endforelse --}}
     </select>
 </div>
