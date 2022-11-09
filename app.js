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

        this.users = getData('http://ajax1.lmsoft.cz/procedure.php?cmd=getPeopleList')
        this.types = getData('http://ajax1.lmsoft.cz/procedure.php?cmd=getTypesList')

        this.toastElement = frm.getElementsByTagName("span")[0]

        this.generateForm()

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

    generateForm() {
        for (let i = 0; i < 3; i++) {
            let user = this.users[i + 1];
            this.usersElement.innerHTML += `<option value=\"${user.ID}\">${user.name}</option>`
        }

        for (let i = 0; i < 5; i++) {
            let type = this.types[i + 1];
            this.typesElement.innerHTML += `<option value=\"${i + 1}\">${type.typ}</option>`
        }
    }



}

class SummaryTable {
    constructor(tbl) {
        this.tableElement = tbl;
        this.refresh()
    }

    refresh() {
        let data = getData('http://ajax1.lmsoft.cz/procedure.php?cmd=getSummaryOfDrinks');
        let tbody = this.tableElement.getElementsByTagName('tbody')[0]
        data.forEach(personData => {
            tbody.innerHTML += `<tr><td>${personData[2]}</td><td>${personData[0]}</td><td>${personData[1]}</td></tr>`
        });

    }


}


c = new CoffeeForm(document.getElementById("AddCoffeForm"))
st = new SummaryTable(document.getElementById("SummaryTable"))