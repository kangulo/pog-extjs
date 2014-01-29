<option value="BIGINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BIGINT"?"selected":'')?>>BIGINT</option>
<option value="BIGSERIAL" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BIGSERIAL"?"selected":'')?>>BIGSERIAL</option>
<option value="BIT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BIT"?"selected":'')?>>BIT</option>
<option value="BOOLEAN" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BOOLEAN"?"selected":'')?>>BOOLEAN</option>
<option value="BOX" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BYTEA"?"selected":'')?>>BYTEA</option>
<option value="BYTEA" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DOUBLE"?"selected":'')?>>DOUBLE</option>
<option value="CIRCLE" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="CIRCLE"?"selected":'')?>>CIRCLE</option>
<option value="DATE" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DATE"?"selected":'')?>>DATE</option>
<option value="DOUBLE PRECISION" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DOUBLE PRECISION"?"selected":'')?>>DOUBLE PRECISION</option>
<option value="INET" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="INET"?"selected":'')?>>INET</option>
<option value="INTEGER" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="INTEGER"?"selected":'')?>>INTEGER</option>
<option value="LINE" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="LINE"?"selected":'')?>>LINE</option>
<option value="LSEG" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="LSEG"?"selected":'')?>>LSEG</option>
<option value="MACADDR" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="MACADDR"?"selected":'')?>>MACADDR</option>
<option value="MONEY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="MONEY"?"selected":'')?>>MONEY</option>
<option value="OID" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="OID"?"selected":'')?>>OID</option>
<option value="PATH" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="PATH"?"selected":'')?>>PATH</option>
<option value="POINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="POINT"?"selected":'')?>>POINT</option>
<option value="POLYGON" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="POLYGON"?"selected":'')?>>POLYGON</option>
<option value="REAL" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="REAL"?"selected":'')?>>REAL</option>
<option value="SMALLINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="SMALLINT"?"selected":'')?>>SMALLINT</option>
<option value="SERIAL" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="SERIAL"?"selected":'')?>>SERIAL</option>
<option value="TEXT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="TEXT"?"selected":'')?>>TEXT</option>
<option value="VARCHAR(255)" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="VARCHAR(255)"?"selected":'')?>>VARCHAR(255)</option>
<option value="OTHER">OTHER...</option>
<option value="HASMANY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="HASMANY"?"selected":'')?>>{ CHILD }</option>
<option value="BELONGSTO" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BELONGSTO"?"selected":'')?>>{ PARENT }</option>
<option value="JOIN" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="JOIN"?"selected":'')?>>{ SIBLING }</option>