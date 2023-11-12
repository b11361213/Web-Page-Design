function csvConvert(str) {return str.split(',').map(x=>x.trim()).filter(x=>x);}
function langChange(obj) {
    // change language
    let lang = $(obj).text();
    $('body').attr('language', lang);
    
    // change font and size
    let elems = 'title, content, indentSubcontent, subContent, subForm';
    elems = csvConvert(elems);
    for (let elemsArray of elems) {
        let elem = document.querySelectorAll(`[class=${elemsArray}]`);
        for (let elemItem of elem) {
            // elemItem.style = lang=='Chinese' ? 'font-family: EduKai;' : 'font-family: NotoSefif;';
            elemItem.style.fontFamily = lang == 'Chinese' ? 'EduKai' : 'NotoSefif';
            switch (elemsArray) {
                case 'title':
                    elemItem.style.fontSize = lang == 'Chinese' ? '36px' : '30px';
                    break;
                case 'content':
                    elemItem.style.fontSize = lang == 'Chinese' ? '24px' : '22px';
                    break;
                case 'indentSubcontent':
                    elemItem.style.fontSize = lang == 'Chinese' ? '24px' : '22px';
                    break;
                case 'subContent':
                    elemItem.style.fontSize = lang == 'Chinese' ? '24px' : '22px';
                    break;
                case 'subForm':
                    elemItem.style.fontSize = lang == 'Chinese' ? '22px' : '20px';
                //     break;
                default:
                    break;
            }
        }
    }
    // [透過 JavaScript 動態修改CSS 樣式、屬性 - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天](https://ithelp.ithome.com.tw/articles/10226003)
    // [DOM CSS 修改 CSS 樣式 - JavaScript (JS) 教學 Tutorial](https://www.fooish.com/javascript/dom/css.html)
}
function login() {
    let username = $('[dataMemberUsername]').val();
    let password = $('[dataMemberPassword]').val();
    // let username = document.querySelector('[dataMemberUsername]');
    // console.log($(username).val());https://vscode.dev/
    // console.log($(password).val());
    $.post('query.php', {query: 'login', username, password}, function(element) {
        let {status} = element;
        let {arrayResult} = element; arrayResult = arrayResult[0];
        
        if (status == 'Login succeeded') {
            let {dataMemberUsernameMemberText, dataMemberEmailMemberText} = arrayResult;
            let username = dataMemberUsernameMemberText;
            let email = dataMemberEmailMemberText;
            $('[LoginForm]').hide()
            alert(`${status}\n\nWelcome -- ${username}`);
        }
        // console.log(status);
        // console.log(arrayResult);
    }, 'json');
}
$.fn.OnClick = function(fun) {
    let o = this;
    $(o).css('cursor', 'pointer');
    $(o).on('click', fun);
    return this;
}
$.fn.dataFormUpdate = function(value) {
    let o = this;
    let col = $(o).closest('[dataForm]').attr('dataForm');
    // console.log(col);
    let row = $(o).closest('[row]').prop('row');
    // console.log(row);
    let {dataFormPrimaryKey} = row;
    $.post('query.php', {query: 'modify', dataFormPrimaryKey, col, value}, function(msg) {
        console.log(msg);
    }, 'json');
}

// 申請...
$.fn.applyForSelect = function(row) {
    let o = this;
    $(o).attr('row', '').prop('row', row);
    let {dataFormApplyForPurposeChoice} = row;
    let dataForms = csvConvert(`dataFormFirstTime, dataFormCertificateHasCeased, dataFormLost, dataFormReplacement, dataFormEnglishVersion`);
    $(`[valueIndex="${dataForms[0]}"]`, o).attr('select', dataFormApplyForPurposeChoice == 'dataFormFirstTime' ? 'true' : 'false');
    $(`[valueIndex="${dataForms[1]}"]`, o).attr('select', dataFormApplyForPurposeChoice == 'dataFormCertificateHasCeased' ? 'true' : 'false');
    $(`[valueIndex="${dataForms[2]}"]`, o).attr('select', dataFormApplyForPurposeChoice == 'dataFormLost' ? 'true' : 'false');
    $(`[valueIndex="${dataForms[3]}"]`, o).attr('select', dataFormApplyForPurposeChoice == 'dataFormReplacement' ? 'true' : 'false');
    $(`[valueIndex="${dataForms[4]}"]`, o).attr('select', dataFormApplyForPurposeChoice == 'dataFormEnglishVersion' ? 'true' : 'false');
}
function applyForSel(obj) {
    let i18ns = csvConvert(`firstTime, certificateHasCeased, lost, replacement, englishVersion`);
    let dataForms = csvConvert(`dataFormFirstTime, dataFormCertificateHasCeased, dataFormLost, dataFormReplacement, dataFormEnglishVersion`);

    // let items = ['firstTime', 'certificateHasCeased', 'lost', 'replacement', 'englishVersion'];

    for (let index = 0; index < i18ns.length; index++) {
        $(`<div class="indentSubcontent" select="false" i18n="${i18ns[index]}" dataForm="dataFormApplyForPurposeChoice" valueIndex="${dataForms[index]}"></div>`).appendTo(obj).OnClick(function(e) {
            let u = e.currentTarget;
            let select = $(u).attr('select');
            if (select == 'false') {
                select = 'true';
                $(u).siblings().attr('select', 'false');
            }
            else {
                select = 'false';
            }
            $(u).attr('select', select);
            $(u).dataFormUpdate(dataForms[index]);
        });
    }
}

// 申請人資料...
$.fn.fillInSelect = function(row) {
    let o = this;
    $(o).attr('row', '').prop('row', row);
    let {dataFormApplicantFormText, dataFormIdentityCardNumberFormText, dataFormContactNumberFormText, dataFormPhoneNumberFormText, dataFormAddressFormText} = row;
    // let value = dataFormApplicantFormText;
    // $('[dataForm=dataFormApplicantFormText]').html(value);
    $('[dataForm="dataFormApplicantFormText"]'            ).html(dataFormApplicantFormText);
    $('[dataForm="dataFormIdentityCardNumberFormText"]'   ).html(dataFormIdentityCardNumberFormText);
    $('[dataForm="dataFormContactNumberFormText"]'        ).html(dataFormContactNumberFormText);
    $('[dataForm="dataFormPhoneNumberFormText"]'          ).html(dataFormPhoneNumberFormText);
    $('[dataForm="dataFormAddressFormText"]'              ).html(dataFormAddressFormText);
}
function fillOut(obj, tag) {
    $.fn.fillIn = function(i18n, dataForm) {
        let obj = this;
        let value = 5050;
        $(`
        <span i18n="${i18n}" title></span>
        `).appendTo(obj);
        $(`
        <span dataForm="${dataForm}" content>${value}</span>
        `).appendTo(obj).OnClick((e)=>{
            let u = $(e.currentTarget);
            let old = u.html(); u.html('');
            let tbox = $('<textarea rows=1 cols=12>').html(old).appendTo(u).OnClick((e)=>{
                    let o = $(e.currentTarget);
                    e.stopPropagation();
                }).on('blur', e=>{
                    let tbox = e.currentTarget;
                    $(u).html($(tbox).val());
                    $(u).dataFormUpdate($(tbox).val());
                });

                tbox.get(0).setSelectionRange(old.length, old.length);
                tbox.trigger('focus');
            });
            return this;
        }

    if (tag == 'info') {
    obj.fillIn('applicant', 'dataFormApplicantFormText').append('<fillOne>').fillIn('identityCardNumber', 'dataFormIdentityCardNumberFormText').append('<fillOne>');
    }
    if (tag == 'contact') {
        obj.fillIn('contactNumber', 'dataFormContactNumberFormText').append('<fillOne>').fillIn('phoneNumber', 'dataFormPhoneNumberFormText').append('<fillOne>');
    }
    if (tag == 'address') {
        obj.fillIn('address', 'dataFormAddressFormText').append('<fillOne>');
    }
}
$.fn.residenceSelect = function(row) {
    let o = this;
    $(o).attr('row', '').prop('row', row);
    let {dataFormResidenceFormChoice} = row;

    $('[valueIndex="dataFormTaipeiCity"]',          o).attr('select', dataFormResidenceFormChoice == '台北市' ? 'true' : 'false');
    $('[valueIndex="dataFormKeelungCity"]',         o).attr('select', dataFormResidenceFormChoice == '基隆市' ? 'true' : 'false');
    $('[valueIndex="dataFormNewTaipeiCity"]',       o).attr('select', dataFormResidenceFormChoice == '新北市' ? 'true' : 'false');
    $('[valueIndex="dataFormLienchiangCounty"]',    o).attr('select', dataFormResidenceFormChoice == '連江縣' ? 'true' : 'false');

    $('[valueIndex="dataFormYilanCounty"]',         o).attr('select', dataFormResidenceFormChoice == '宜蘭縣' ? 'true' : 'false');
    $('[valueIndex="dataFormHsinchuCity"]',         o).attr('select', dataFormResidenceFormChoice == '新竹市' ? 'true' : 'false');
    $('[valueIndex="dataFormHsinchuCounty"]',       o).attr('select', dataFormResidenceFormChoice == '新竹縣' ? 'true' : 'false');
    $('[valueIndex="dataFormTaoyuanCity"]',         o).attr('select', dataFormResidenceFormChoice == '桃園市' ? 'true' : 'false');

    $('[valueIndex="dataFormMiaoliCounty"]',        o).attr('select', dataFormResidenceFormChoice == '苗栗縣' ? 'true' : 'false');
    $('[valueIndex="dataFormTaichungCity"]',        o).attr('select', dataFormResidenceFormChoice == '台中市' ? 'true' : 'false');
    $('[valueIndex="dataFormChanghuaCounty"]',      o).attr('select', dataFormResidenceFormChoice == '彰化縣' ? 'true' : 'false');
    $('[valueIndex="dataFormNantouCounty"]',        o).attr('select', dataFormResidenceFormChoice == '南投縣' ? 'true' : 'false');
    
    $('[valueIndex="dataFormChiayiCity"]',          o).attr('select', dataFormResidenceFormChoice == '嘉義市' ? 'true' : 'false');
    $('[valueIndex="dataFormChiayiCounty"]',        o).attr('select', dataFormResidenceFormChoice == '嘉義縣' ? 'true' : 'false');
    $('[valueIndex="dataFormYunlinCounty"]',        o).attr('select', dataFormResidenceFormChoice == '雲林縣' ? 'true' : 'false');
    $('[valueIndex="dataFormTainanCity"]',          o).attr('select', dataFormResidenceFormChoice == '台南市' ? 'true' : 'false');
    
    $('[valueIndex="dataFormKaohsiungCity"]',       o).attr('select', dataFormResidenceFormChoice == '高雄市' ? 'true' : 'false');
    $('[valueIndex="dataFormPenghuCounty"]',        o).attr('select', dataFormResidenceFormChoice == '澎湖縣' ? 'true' : 'false');
    $('[valueIndex="dataFormKinmenCounty"]',        o).attr('select', dataFormResidenceFormChoice == '金門縣' ? 'true' : 'false');
    $('[valueIndex="dataFormPingtungCounty"]',      o).attr('select', dataFormResidenceFormChoice == '屏東縣' ? 'true' : 'false');
    
    $('[valueIndex="dataFormTaitungCounty"]',       o).attr('select', dataFormResidenceFormChoice == '台東縣' ? 'true' : 'false');
    $('[valueIndex="dataFormHualienCounty"]',       o).attr('select', dataFormResidenceFormChoice == '花蓮縣' ? 'true' : 'false');
}
function residenceSel(obj) {
    let i18ns = csvConvert(`
        taipeiCity, keelungCity, newTaipeiCity, lienchiangCounty, 
        yilanCounty, hsinchuCity, hsinchuCounty, taoyuanCity, 
        miaoliCounty, taichungCity, changhuaCounty, nantouCounty, 
        chiayiCity, chiayiCounty, yunlinCounty, tainanCity, 
        kaohsiungCity, penghuCounty, kinmenCounty, pingtungCounty, 
        taitungCounty, hualienCounty
        `);

    let valueIndex = csvConvert(`
        dataFormTaipeiCity, dataFormKeelungCity, dataFormNewTaipeiCity, dataFormLienchiangCounty, 
        dataFormYilanCounty, dataFormHsinchuCity, dataFormHsinchuCounty, dataFormTaoyuanCity, 
        dataFormMiaoliCounty, dataFormTaichungCity, dataFormChanghuaCounty, dataFormNantouCounty, 
        dataFormChiayiCity, dataFormChiayiCounty, dataFormYunlinCounty, dataFormTainanCity, 
        dataFormKaohsiungCity, dataFormPenghuCounty, dataFormKinmenCounty, dataFormPingtungCounty, 
        dataFormTaitungCounty, dataFormHualienCounty
        `);
    let values = csvConvert(`
        台北市, 基隆市, 新北市, 連江縣, 
        宜蘭縣, 新竹市, 新竹縣, 桃園市, 
        苗栗縣, 台中市, 彰化縣, 南投縣, 
        嘉義市, 嘉義縣, 雲林縣, 台南市, 
        高雄市, 澎湖縣, 金門縣, 屏東縣, 
        台東縣, 花蓮縣
        `);

    for (let index = 0; index < i18ns.length; index++) {
        $(`<span style=white-space: nowrap select="false" i18n="${i18ns[index]}" dataForm="dataFormResidenceFormChoice" valueIndex="${valueIndex[index]}" id="checkboxOption"></div>`).appendTo(obj).OnClick(function(e) {
            let u = e.currentTarget;
            let select = $(u).attr('select');
            if (select == 'false') {
                select = 'true';
                $(u).siblings().attr('select', 'false');
            }
            else {
                select = 'false';
            }
            $(u).attr('select', select);
            $(u).dataFormUpdate(values[index]);
        });
    };
}