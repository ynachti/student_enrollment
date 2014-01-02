<?php

/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\OCI8\Driver',
                'params' => array(
                    'username' => 'test1',
                    'password' => 'w8e6u_e',
                    'connectionstring' => '(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = SEFS-INFRA.SYSAPPS.UNLV.EDU)(PORT = 1521))) 
                                                (CONNECT_DATA = (SERVICE_NAME = slifedev.sefsinfra.sysapps.unlv.edu) (SRVR = DEDICATED))
                                                )',
//                    'username' => 'tranreq',
//                    'password' => 'HBTR%iMo9',
//                    'connectionstring' => '(DESCRIPTION =
//                                                    (ADDRESS_LIST =
//                                                        (ADDRESS = (PROTOCOL = TCP)(HOST = SEFS-INFRA.SYSAPPS.UNLV.EDU)(PORT = 1521))
//                                                        )
//                                                            (CONNECT_DATA =
//                                                                (SERVICE_NAME = slifedev.sefsinfra.sysapps.unlv.edu)
//                                                            )
//                                                )',
                )
            )
        )
    ),
    'db_mysql_local' => array(
        'username' => 'root',
        'password' => ''
    ),
    'ZfcDatagrid' => array(
        'defaults' => array(
            // If no specific rendere given, use this renderes for HTTP / console
            'renderer' => array(
                'http' => 'bootstrapTable',
                'console' => 'zendTable'
            ),
            // general available export formats
            'export' => array(
                'tcpdf' => 'PDF',
                'phpExcel' => 'Excel'
            )
        ),
        'cache' => array(
            'adapter' => array(
                'name' => 'Filesystem',
                'options' => array(
                    'ttl' => 720000, // cache with 200 hours,
                    'cache_dir' => 'data/ZfcDatagrid'
                )
            ),
            'plugins' => array(
                'exception_handler' => array(
                    'throw_exceptions' => false
                ),
                'Serializer'
            )
        ),
        'renderer' => array(
            'bootstrapTable' => array(
                'parameterNames' => array(
                    // Internal => bootstrapTable
                    'currentPage' => 'currentPage',
                    'sortColumns' => 'sortByColumns',
                    'sortDirections' => 'sortDirections'
                )
            ),
            'jqGrid' => array(
                'parameterNames' => array(
                    // Internal => jqGrid
                    'currentPage' => 'currentPage',
                    'itemsPerPage' => 'itemsPerPage',
                    'sortColumns' => 'sortByColumns',
                    'sortDirections' => 'sortDirections',
                    'isSearch' => 'isSearch',
                    'columnsHidden' => 'columnsHidden',
                    'columnsGroupByLocal' => 'columnsGroupBy'
                )
            ),
            'zendTable' => array(
                'parameterNames' => array(
                    // Internal => ZendTable (console)
                    'currentPage' => 'page',
                    'itemsPerPage' => 'items',
                    'sortColumns' => 'sortBys',
                    'sortDirections' => 'sortDirs',
                    'filterColumns' => 'filterBys',
                    'filterValues' => 'filterValues'
                )
            )
        ),
        // General parameters
        'generalParameterNames' => array(
            'rendererType' => 'rendererType'
        )
    ),
);
