function changeArea(order)
{
    var area = 0;
    var eName = 'area_id' + order;
    var radios = document.getElementsByName(eName);
    for (i = 0; i < radios.length; i++)
    {
        if (radios[i].checked)
            area = radios[i].value;
    }
    document.getElementById("area" + order).value = area;
}

function fncSubmit()
{
    if (document.getElementById('email').value == "")
    {
        alert('Please identify Email');
        document.getElementById('email').focus();
        return false;
    }
    if (document.getElementById('tel').value == "")
    {
        alert('Please identify โทรศัพท์');
        document.getElementById('tel').focus();
        return false;
    }
    if (document.getElementById('address').value == "")
    {
        alert('Please identify บ้านเลขที่');
        document.getElementById('address').focus();
        return false;
    }
    if (document.getElementById('moo').value == "")
    {
        alert('Please identify หมู่ที่');
        document.getElementById('moo').focus();
        return false;
    }
    if (document.getElementById('subdistrict').value == "")
    {
        alert('Please identify ตำบล/แขวง');
        document.getElementById('subdistict').focus();
        return false;
    }
    if (document.getElementById('district').value == "")
    {
        alert('Please identify อำเภอ/เขต');
        document.getElementById('district').focus();
        return false;
    }
    if (document.getElementById('province_id0').value == "0")
    {
        alert('Please select จังหวัด');
        document.getElementById('province_id0').focus();
        return false;
    }
    if (document.getElementById('postcode').value == "")
    {
        alert('Please identify รหัสไปรษณีย์');
        document.getElementById('postcode').focus();
        return false;
    }
    if (document.getElementById('car1').checked == false)
    {
        alert('Please check box');
        document.getElementById('car1').focus();
        return false;

    } else if (document.getElementById('car1').checked == true)
    {
        if (document.getElementById('car_regis_number1').value == "")
        {
            alert('Please identify หมายเลขทะเบียน');
            document.getElementById('car_regis_number1').focus();
            return false;
        }
        if (document.getElementById('province_id1').value == "0")
        {
            alert('Please select จังหวัด');
            document.getElementById('province_id1').focus();
            return false;
        }
        if (document.getElementById('brand_id1').value == "0")
        {
            alert('Please select ยี่ห้อรถยนต์');
            document.getElementById('brand_id1').focus();
            return false;
        }
        if (document.getElementById('color_id1').value == "0")
        {
            alert('Please select สี');
            document.getElementById('color_id1').focus();
            return false;
        }
        if (document.getElementById('ctype_id1').value == "0")
        {
            alert('Please select ลักษณะ/ประเภทรถยนต์');
            document.getElementById('ctype_id1').focus();
            return false;
        }
        if (document.getElementById('area_id1') == 0)
        {
            alert('Please select ผ่านบริเวณ');
            document.getElementById('area_id1').focus();
            return false;
        }
        if (document.getElementById('car_license1').value == "")
        {
            alert('Please choose file');
            document.getElementById('car_license1').focus();
            return false;
        }
    }
    if (document.getElementById('dupMarriage1').checked == true)
    {
        if (document.getElementById('marriage_license1').value == "")
        {
            alert('Please choose file');
            document.getElementById('marriage_license1').focus();
            return false;
        }
    } else if (document.getElementById('dupMarriage1').checked == false)
    {
        document.getElementById('marriage_license1').value = "";
    }
    if (document.getElementById('dupHouse1').checked == true)
    {
        if (document.getElementById('house_registration1').value == "")
        {
            alert('Please choose file');
            document.getElementById('house_registration1').focus();
            return false;
        }
    } else if (document.getElementById('dupHouse1').checked == false)
    {
        document.getElementById('house_registration1').value = "";
    }
    if (document.getElementById('car2').checked == true)
    {
        if (document.getElementById('car_regis_number2').value == "")
        {
            alert('Please identify หมายเลขทะเบียน');
            document.getElementById('car_regis_number2').focus();
            return false;
        }
        if (document.getElementById('province_id2').value == "0")
        {
            alert('Please select จังหวัด');
            document.getElementById('province_id2').focus();
            return false;
        }
        if (document.getElementById('brand_id2').value == "0")
        {
            alert('Please select ยี่ห้อรถยนต์');
            document.getElementById('brand_id2').focus();
            return false;
        }
        if (document.getElementById('color_id2').value == "0")
        {
            alert('Please select สี');
            document.getElementById('color_id2').focus();
            return false;
        }
        if (document.getElementById('ctype_id2').value == "0")
        {
            alert('Please select ลักษณะ/ประเภทรถยนต์');
            document.getElementById('ctype_id2').focus();
            return false;
        }
        if (document.getElementById('area_id2') == 0)
        {
            alert('Please select ผ่านบริเวณ');
            document.getElementById('area_id2').focus();
            return false;
        }
        if (document.getElementById('car_license2').value == "")
        {
            alert('Please choose file');
            document.getElementById('car_license2').focus();
            return false;
        }
        if (document.getElementById('dupMarriage2').checked == true)
        {
            if (document.getElementById('marriage_license2').value == "")
            {
                alert('Please choose file');
                document.getElementById('marriage_license2').focus();
                return false;
            }
        } else if (document.getElementById('dupMarriage2').checked == false)
        {
            document.getElementById('marriage_license2').value = "";
        }
        if (document.getElementById('dupHouse2').checked == true)
        {
            if (document.getElementById('house_registration2').value == "")
            {
                alert('Please choose file');
                document.getElementById('house_registration2').focus();
                return false;
            }
        } else if (document.getElementById('dupHouse2').checked == false)
        {
            document.getElementById('house_registration2').value = "";
        }
    } else if (document.getElementById('car2').checked == false)
    {
        document.getElementById('car_regis_number2').value = "";
        document.getElementById('province_id2').value = "";
        document.getElementById('brand_id2').value = "";
        document.getElementById('color_id2').value = "";
        document.getElementById('ctype_id2').value = "";
        document.getElementById('area2').value = "";
        document.getElementById('car_license2').value = "";
        document.getElementById('marriage_license2').value = "";
        document.getElementById('house_registration2').value = "";
    }
}