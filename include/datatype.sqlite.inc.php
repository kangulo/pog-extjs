<option value="TEXT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="TEXT"?"selected":'')?>>TEXT</option>
<option value="NUMERIC" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="NUMERIC"?"selected":'')?>>NUMERIC</option>
<option value="INTEGER" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="INTEGER"?"selected":'')?>>INTEGER</option>
<option value="BLOB" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BLOB"?"selected":'')?>>BLOB</option>
<option value="OTHER">OTHER...</option>
<option value="HASMANY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="HASMANY"?"selected":'')?>>{ CHILD }</option>
<option value="BELONGSTO" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BELONGSTO"?"selected":'')?>>{ PARENT }</option>
<option value="JOIN" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="JOIN"?"selected":'')?>>{ SIBLING }</option>