function getData(url) {
    return ($.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        async: false,
        origin: null,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Basic ' + btoa(`coffe:kafe`));
        }
    })).responseJSON
}

class CoffeeForm {

    constructor(frm) {
        this.typesElement = document.getElementById("FormDrinks");
        this.usersElement = document.getElementById("FormUsers");

        this.toastElement = frm.getElementsByTagName("span")[0]


        frm.onsubmit = (event) => {
            event.preventDefault();
            var validity = this.validate()
            if(typeof(validity) == "string"){
                this.toast(validity)
                return false
            }else if(typeof(validity) == "boolean"){
                if (validity){
                    $.ajax({
                        type: "POST",
                        url: 'http://ajax1.lmsoft.cz/procedure.php?cmd=saveDrinks',
                        data: $("#AddCoffeForm").serialize(),
                        async: false,
                        origin: null,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Authorization', 'Basic ' + btoa(`coffe:kafe`));
                        },
                        success: function (data) {
                            console.log(data);
                        }
                    });
                }

                return validity
            }

            return false
        }



        if (localStorage.getItem("typeID") == null) {
            this.typesElement.value = 0
        } else {
            this.typesElement.value = localStorage.getItem("typeID")
        }

        if (localStorage.getItem("userID") == null) {
            this.usersElement.value = 0
        } else {
            this.usersElement.value = localStorage.getItem("userID")
        }

    }

    

    validate() {
        try {
            if (document.forms["addCoffeForm"]["user"].value == 0) {
                throw "Osoba není vyplněna"
            }

            if (document.forms["addCoffeForm"]["type"].value == 0) {
                throw "Typ pití není vyplněn"
            }

            localStorage.setItem("userID", document.forms["addCoffeForm"]["user"].value)
            localStorage.setItem("typeID", document.forms["addCoffeForm"]["type"].value)
            return true
        } catch (error) {
            return error
        }
    }

    toast(msg) {
        this.toastElement.innerHTML = msg
        if (!this.toastElement.classList.contains('active')) {
            this.toastElement.classList.add('active')
        }
    }
}

class SummaryTable {
    constructor(tbl) {
        this.tableElement = tbl;
        this.tbody = this.tableElement.getElementsByTagName('tbody')[0]
    }

}


c = new CoffeeForm(document.getElementById("AddCoffeForm"))
st = new SummaryTable(document.getElementById("SummaryTable"))