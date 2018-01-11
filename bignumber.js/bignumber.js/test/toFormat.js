var count = (function toFormat(BigNumber) {
    var start = +new Date(),
        log,
        error,
        format,
        u,
        passed = 0,
        total = 0;

    if (typeof window === 'undefined') {
        log = console.log;
        error = console.error;
    } else {
        log = function (str) { document.body.innerHTML += str.replace('\n', '<br>') };
        error = function (str) { document.body.innerHTML += '<div style="color: red">' +
          str.replace('\n', '<br>') + '</div>' };
    }

    if (!BigNumber && typeof require === 'function') BigNumber = require('../bignumber');

    function assert(expected, actual) {
        total++;
        if (expected !== actual) {
           error('\n Test number: ' + total + ' failed');
           error(' Expected: ' + expected);
           error(' Actual:   ' + actual);
           //process.exit();
        } else {
            passed++;
            //log('\n Expected and actual: ' + actual);
        }
    }

    function assertException(func, message) {
        var actual;
        total++;
        try {
            func();
        } catch (e) {
            actual = e;
        }
        if (actual && actual.name == 'BigNumber Error') {
            passed++;
            //log('\n Expected and actual: ' + actual);
        } else {
            error('\n Test number: ' + total + ' failed');
            error('\n Expected: ' + message + ' to raise a BigNumber Error.');
            error(' Actual:   ' + (actual || 'no exception'));
            //process.exit();
        }
    }

    function T(expected, value, dp){
        assert(expected, new BigNumber(value).toFormat(dp));
    }

    log('\n Testing toFormat...');

    format = {
        decimalSeparator: '.',
        groupSeparator: ',',
        groupSize: 3,
        secondaryGroupSize: 0,
        fractionGroupSeparator: ' ',
        fractionGroupSize: 0
    };

    BigNumber.config({
        DECIMAL_PLACES: 20,
        ROUNDING_MODE: 4,
        ERRORS: true,
        RANGE: 1E9,
        EXPONENTIAL_AT: [-7, 21],
        FORMAT: format
    });

    T('0', 0);
    T('1', 1);
    T('-1', -1);
    T('123.456', 123.456);
    T('NaN', NaN);
    T('Infinity', 1/0);
    T('-Infinity', -1/0);

    T('0', 0, null);
    T('1', 1, undefined);
    T('-1', -1, 0);
    T('123.456', 123.456, 3);
    T('NaN', NaN, 0);
    T('Infinity', 1/0, 3);
    T('-Infinity', -1/0, 0);

    T('0.0', 0, 1);
    T('1.00', 1, 2);
    T('-1.000', -1, 3);
    T('123.4560', 123.456, 4);
    T('NaN', NaN, 5);
    T('Infinity', 1/0, 6);
    T('-Infinity', -1/0, 7);

    T('9,876.54321', 9876.54321);
    T('4,018,736,400,000,000,000,000', '4.0187364e+21');

    T('999,999,999,999,999', 999999999999999);
    T('99,999,999,999,999',  99999999999999);
    T('9,999,999,999,999',   9999999999999);
    T('999,999,999,999',     999999999999);
    T('99,999,999,999',      99999999999);
    T('9,999,999,999',       9999999999);
    T('999,999,999',         999999999);
    T('99,999,999',          99999999);
    T('9,999,999',           9999999);
    T('999,999',             999999);
    T('99,999',              99999);
    T('9,999',               9999);
    T('999',                 999);
    T('99',                  99);
    T('9',                   9);

    T('76,852.342091', '7.6852342091e+4');

    format.groupSeparator = ' ';

    T('76 852.34', '7.6852342091e+4', 2);
    T('76 852.342091', '7.6852342091e+4');
    T('76 852.3420910871', '7.6852342091087145832640897e+4', 10);

    format.fractionGroupSize = 5;

    T('4 018 736 400 000 000 000 000', '4.0187364e+21');
    T('76 852.34209 10871 45832 64089', '7.685234209108714583264089e+4', 20);
    T('76 852.34209 10871 45832 64089 7', '7.6852342091087145832640897e+4', 21);
    T('76 852.34209 10871 45832 64089 70000', '7.6852342091087145832640897e+4', 25);

    T('999 999 999 999 999',  999999999999999, 0);
    T('99 999 999 999 999.0', 99999999999999, 1);
    T('9 999 999 999 999.00', 9999999999999, 2);
    T('999 999 999 999.000',  999999999999, 3);
    T('99 999 999 999.0000',  99999999999, 4);
    T('9 999 999 999.00000',  9999999999, 5);
    T('999 999 999.00000 0',  999999999, 6);
    T('99 999 999.00000 00',  99999999, 7);
    T('9 999 999.00000 000',  9999999, 8);
    T('999 999.00000 0000',   999999, 9);
    T('99 999.00000 00000',   99999, 10);
    T('9 999.00000 00000 0',  9999, 11);
    T('999.00000 00000 00',   999, 12);
    T('99.00000 00000 000',   99, 13);
    T('9.00000 00000 0000',   9, 14);

    T('1.00000 00000 00000', 1, 15);
    T('1.00000 00000 0000', 1, 14);
    T('1.00000 00000 000', 1, 13);
    T('1.00000 00000 00', 1, 12);
    T('1.00000 00000 0', 1, 11);
    T('1.00000 00000', 1, 10);
    T('1.00000 0000', 1, 9);

    format.fractionGroupSize = 0;

    T('4 018 736 400 000 000 000 000', '4.0187364e+21');
    T('76 852.34209108714583264089', '7.685234209108714583264089e+4', 20);
    T('76 852.342091087145832640897', '7.6852342091087145832640897e+4', 21);
    T('76 852.3420910871458326408970000', '7.6852342091087145832640897e+4', 25);

    T('999 999 999 999 999',  999999999999999, 0);
    T('99 999 999 999 999.0', 99999999999999, 1);
    T('9 999 999 999 999.00', 9999999999999, 2);
    T('999 999 999 999.000',  999999999999, 3);
    T('99 999 999 999.0000',  99999999999, 4);
    T('9 999 999 999.00000',  9999999999, 5);
    T('999 999 999.000000',   999999999, 6);
    T('99 999 999.0000000',   99999999, 7);
    T('9 999 999.00000000',   9999999, 8);
    T('999 999.000000000',    999999, 9);
    T('99 999.0000000000',    99999, 10);
    T('9 999.00000000000',    9999, 11);
    T('999.000000000000',     999, 12);
    T('99.0000000000000',     99, 13);
    T('9.00000000000000',     9, 14);

    T('1.000000000000000', 1, 15);
    T('1.00000000000000', 1, 14);
    T('1.0000000000000', 1, 13);
    T('1.000000000000', 1, 12);
    T('1.00000000000', 1, 11);
    T('1.0000000000', 1, 10);
    T('1.000000000', 1, 9);

    format = {
        decimalSeparator: '.',
        groupSeparator: ',',
        groupSize: 3,
        secondaryGroupSize: 2
    };
    BigNumber.config({ FORMAT: format });

    T('9,876.54321', 9876.54321);
    T('10,00,037.123', '1000037.123456789', 3);
    T('4,01,87,36,40,00,00,00,00,00,000', '4.0187364e+21');

    T('99,99,99,99,99,99,999', 999999999999999);
    T('9,99,99,99,99,99,999',  99999999999999);
    T('99,99,99,99,99,999',    9999999999999);
    T('9,99,99,99,99,999',     999999999999);
    T('99,99,99,99,999',       99999999999);
    T('9,99,99,99,999',        9999999999);
    T('99,99,99,999',          999999999);
    T('9,99,99,999',           99999999);
    T('99,99,999',             9999999);
    T('9,99,999',              999999);
    T('99,999',                99999);
    T('9,999',                 9999);
    T('999',                   999);
    T('99',                    99);
    T('9',                     9);

    format.decimalSeparator = ',';
    format.groupSeparator = '.';

    T('1.23.45.60.000,000000000008', '1.23456000000000000000789e+9', 12);

    format.groupSeparator = '';

    T('10000000000123456789000000,0000000001', '10000000000123456789000000.000000000100000001', 10);

    format.groupSeparator = ' ';
    format.groupSize = 1;
    format.secondaryGroupSize = 4;

    T('4658 0734 6509 8347 6580 3645 0,6', '4658073465098347658036450.59764985763489569875659876459', 1);

    format.fractionGroupSize = 2;
    format.fractionGroupSeparator = ':';
    format.secondaryGroupSize = null;

    T('4 6 5 8 0 7 3 4 6 5 0 9 8 3 4 7 6 5 8 0 3 6 4 5 0,59:76:49:85:76:34:89:56:98:75:65:98:76:45:9', '4658073465098347658036450.59764985763489569875659876459' );

    log('\n ' + passed + ' of ' + total + ' tests passed in ' + (+new Date() - start) + ' ms \n');
    return [passed, total];
})(this.BigNumber);
if (typeof module !== 'undefined' && module.exports) module.exports = count;
