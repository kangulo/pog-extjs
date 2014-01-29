<option value="BLOB" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BLOB"?"selected":'')?>>BLOB</option>
<option value="CHAR" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="CHAR"?"selected":'')?>>CHAR</option>
<option value="CHAR(1)" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="CHAR(1)"?"selected":'')?>>CHAR(1)</option>
<option value="TIMESTAMP" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="TIMESTAMP"?"selected":'')?>>TIMESTAMP</option>
<option value="DECIMAL" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DECIMAL"?"selected":'')?>>DECIMAL</option>
<option value="DOUBLE" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DOUBLE"?"selected":'')?>>DOUBLE</option>
<option value="FLOAT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="FLOAT"?"selected":'')?>>FLOAT</option>
<option value="INT64" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="INT64"?"selected":'')?>>INT64</option>
<option value="INTEGER" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="INTEGER"?"selected":'')?>>INTEGER</option>
<option value="NUMERIC" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="NUMERIC"?"selected":'')?>>NUMERIC</option>
<option value="SMALLINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="SMALLINT"?"selected":'')?>>SMALLINT</option>
<option value="VARCHAR(255)" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="VARCHAR(255)"?"selected":'')?>>VARCHAR(255)</option>
<option value="OTHER">OTHER...</option>
<option value="HASMANY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="HASMANY"?"selected":'')?>>{ CHILD }</option>
<option value="BELONGSTO" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BELONGSTO"?"selected":'')?>>{ PARENT }</option>
<option value="JOIN" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="JOIN"?"selected":'')?>>{ SIBLING }</option>