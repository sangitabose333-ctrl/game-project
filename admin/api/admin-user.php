<?php
session_start();
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Database connection information */

require_once ('../../../conn.php');
include '../../../controller.php';

$extraColumns = ($companyid)?[]:['c.domain'];
$extraColumnsValue = ($companyid)?[]:['COALESCE(c.domain,"NA") as domain'];

$filter_type = $_GET['filter_type'] ?? '';

$aColumns     = array_merge(['a.id', 'a.name', 'a.username', 'a.pwd', 'a.comp_id', 'COALESCE(r.role_name,"NA") as role_name'], $extraColumnsValue);
$asColumns    = array_merge(['a.id', 'a.name', 'a.username', 'a.pwd', 'a.comp_id', 'r.role_name'], $extraColumns);
$asortColumns = array_merge(['a.id', 'a.name', 'a.username', 'a.pwd', 'a.comp_id', 'r.role_name'], $extraColumns);
$aaColumns    = ['slno', 'name', 'username', 'pwd', 'domain', 'role_name'];



/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.id";

/* DB table to use */
$sTable = " `admin` as a LEFT JOIN `admin_role` as r ON a.role=r.id";

/* DB table to use joining*/
$jTable = " LEFT JOIN `company` as c ON a.id=c.assign_owner";




/*
 * Paging
 */
$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
{
    $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
        intval( $_GET['iDisplayLength'] );
}


/*
 * Ordering
 */
$sOrder = "";
if ( isset( $_GET['iSortCol_0'] ) )
{
    $sOrder = "ORDER BY  ";
    for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
    {
        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
        {
            $sOrder .= $asortColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
        }
    }

    $sOrder = substr_replace( $sOrder, "", -2 );
    if ( $sOrder == "ORDER BY" )
    {
        $sOrder = "";
    }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere =  "";
if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
{
    $sWhere .= "WHERE (";
    for ( $i=0 ; $i<count($asColumns) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
        {
            $sWhere .= $asColumns[$i]." LIKE '%".mysqli_real_escape_string( $link,$_GET['sSearch'] )."%' OR ";
        }
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';
}

/* Individual column filtering */
for ( $i=0 ; $i<count($asColumns) ; $i++ ){
    
    if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
        
        if ( $sWhere == "" ){
            $sWhere = "WHERE ";
        }else{
            $sWhere .= " AND ";
        }
        $sWhere .= $asColumns[$i]." LIKE '%".mysqli_real_escape_string($link,$_GET['sSearch_'.$i])."%' ";
    }
}

$sWhere .= ( $sWhere == "" )?"WHERE a.`id` NOT IN(1,$_SESSION[adminlog]) AND a.comp_id=$companyid":" AND a.`id` NOT IN(1,1) AND a.comp_id=$companyid ";

$filterWhere = " a.`id` NOT IN(1,$_SESSION[adminlog]) AND a.comp_id=$companyid";
/*
 * SQL queries
 * Get data to display SELECT * FROM users
 */
$joinTable = (!$companyid)?$jTable:'';


if($filter_type == 'company_admin'){
    $filterWhere .= ($filterWhere == "")? "WHERE a.`comp_owner`='owner'":" AND a.`comp_owner`='owner'";
    $sWhere .= ($sWhere == "")? "WHERE a.`comp_owner`='owner'":" AND a.`comp_owner`='owner'";;
}elseif($filter_type == 'subadmin'){
    $filterWhere .= ($filterWhere == "")? "WHERE (a.`comp_owner` IS null or a.`comp_owner`='')":" AND (a.`comp_owner` IS null or a.`comp_owner`='')";
    $sWhere .= ($sWhere == "")? "WHERE (a.`comp_owner` IS null or a.`comp_owner`='')":" AND (a.`comp_owner` IS null or a.`comp_owner`='')";
}

$sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM $sTable 
        $joinTable
        $sWhere
        $sOrder
        $sLimit
    ";

$rResult = mysqli_query($link, $sQuery );

/* Data set length after filtering */
$sQuery = "
        SELECT FOUND_ROWS()
    ";
$rResultFilterTotal = mysqli_query($link , $sQuery);
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM $sTable $joinTable WHERE $filterWhere
    ";

$rResultTotal = mysqli_query($link ,$sQuery);
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];

/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$j=0;
$serial_no = intval( $_GET['iDisplayStart'] );

while ($aRow = mysqli_fetch_array($rResult))
{
    $row = array();
    $j++;

    for ( $i=0 ; $i<count($aaColumns) ; $i++ )
    {
        if ( $aaColumns[$i] != ' ' )
        {
            if($aaColumns[$i] == 'name')
            {
                $row[] = '<strong>'.$aRow[ $aaColumns[$i] ].'</strong>';
            }
            elseif($aaColumns[$i] == 'slno') 
            {
                $row[] = ($serial_no + $j);
            }
            elseif($aaColumns[$i] == 'role_name') 
            {
                if ((in_array("permissions", $ASSIGN_TO_ROLES) || $_SESSION['adminlog']==1) && $aRow[ $aaColumns[$i] ]!='')
                {
                    
                    $row[] = '<button type="button" class="btn blue btn-outline btn-xs" data-toggle="modal" data-target="#permissionModal">'.(($aRow[ $aaColumns[$i] ])?$aRow[ $aaColumns[$i] ]:'NA').'</button>';
                }
                else
                { 
                    $row[] = '<button type="button" class="btn blue btn-outline btn-xs disabled" data-toggle="modal">'.(($aRow[ $aaColumns[$i] ])?$aRow[ $aaColumns[$i] ]:'NA').'</button>';
                } 
            }
            else 
            {
                $row[] = $aRow[ $aaColumns[$i] ];
            }
        }
    }
    $row[] = '
            <a href="javascript:vaid(0);" onclick="createForm(this)" data-form-data-dpboss="'.$aRow['id'].'" data-form-attr-action="login-history"> <img src="../include/sidebar-icon/login-history-target.svg" height="30" width="30"> </a>
            '.((in_array("admin_edit", $ASSIGN_TO_ROLES) || $_SESSION['adminlog']=='1')?'<a type="button" href="javascript:;" onclick="dpbossModal(`edit_admin.php?id='.$aRow['id'].'`)" class="btn btn green btn-outline btn-xs margin-top-10">	<i class="fa fa-edit"></i> Edit</a>&nbsp;':'').
            ((in_array("admin_delete", $ASSIGN_TO_ROLES) || $_SESSION['adminlog']=='1')?'<a href="javascript:;" onclick="del('.$aRow['id'].',\''.addslashes($row[1]).'\')" class="btn btn-outline red btn-xs margin-top-10">	<i class="fa fa-trash-o"></i> Delete</a>':'')
            ;

    $action = (!in_array("admin_edit", $ASSIGN_TO_ROLES) && !in_array("admin_delete", $ASSIGN_TO_ROLES) && $_SESSION['adminlog'] != "1")?false:true;

    $row[] = ['action'=>$action];
    
    $output['aaData'][] = $row;
}

echo json_encode( $output );


?>