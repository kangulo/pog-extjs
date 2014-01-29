<option value="BIGINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BIGINT"?"selected":'')?>>BIGINT</option>
<option value="BIT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BIT"?"selected":'')?>>BIT</option>
<option value="CHAR" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="CHAR"?"selected":'')?>>CHAR</option>
<option value="DATETIME" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DATETIME"?"selected":'')?>>DATETIME</option>
<option value="DECIMAL" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="DECIMAL"?"selected":'')?>>DECIMAL</option>
<option value="FLOAT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="FLOAT"?"selected":'')?>>FLOAT</option>
<option value="IMAGE" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="IMAGE"?"selected":'')?>>IMAGE</option>
<option value="INT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="INT"?"selected":'')?>>INT</option>
<option value="MONEY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="MONEY"?"selected":'')?>>MONEY</option>
<option value="NCHAR" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="NCHAR"?"selected":'')?>>NCHAR</option>
<option value="NTEXT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="NTEXT"?"selected":'')?>>NTEXT</option>
<option value="NUMERIC" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="NUMERIC"?"selected":'')?>>NUMERIC</option>
<option value="NVARCHAR" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="NVARCHAR"?"selected":'')?>>NVARCHAR</option>
<option value="REAL" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="REAL"?"selected":'')?>>REAL</option>
<option value="SMALLDATETIME" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="SMALLDATETIME"?"selected":'')?>>SMALLDATETIME</option>
<option value="SMALLINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="SMALLINT"?"selected":'')?>>SMALLINT</option>
<option value="SMALLMONEY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="SMALLMONEY"?"selected":'')?>>SMALLMONEY</option>
<option value="TEXT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="TEXT"?"selected":'')?>>TEXT</option>
<option value="TIMESTAMP" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="TIMESTAMP"?"selected":'')?>>TIMESTAMP</option>
<option value="TINYINT" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="TINYINT"?"selected":'')?>>TINYINT</option>
<option value="UNIQUEIDENTIFIER" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="UNIQUEIDENTIFIER"?"selected":'')?>>UNIQUEIDENTIFIER</option>
<option value="VARBINARY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="VARBINARY"?"selected":'')?>>VARBINARY</option>
<option value="VARCHAR(255)" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="VARCHAR(255)"?"selected":'')?>>VARCHAR(255)</option>
<option value="OTHER">OTHER...</option>
<option value="HASMANY" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="HASMANY"?"selected":'')?>>{ CHILD }</option>
<option value="BELONGSTO" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="BELONGSTO"?"selected":'')?>>{ PARENT }</option>
<option value="JOIN" <?=(isset($typeList)&&isset($typeList[$dataTypeIndex])&&$typeList[$dataTypeIndex]=="JOIN"?"selected":'')?>>{ SIBLING }</option>