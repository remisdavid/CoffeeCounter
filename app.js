class CoffeeForm {

    constructor(frm) {
        this.typesElement = document.getElementById("FormDrinks");
        this.usersElement = document.getElementById("FormUsers");
        
        this.users = this.getData('http://ajax1.lmsoft.cz/procedure.php?cmd=getPeopleList')
        this.types = this.getData('http://ajax1.lmsoft.cz/procedure.php?cmd=getTypesList')
        
        this.submit = frm.getElementsByTagName('input')[0].addEventListener('click', () => {
            
            frm.submit(function (e) {

                e.preventDefault();
        
                $.ajax({
                    type: frm.attr('method'),
                    url: 'http://ajax1.lmsoft.cz/procedure.php?cmd=saveDrinks',
                    data: frm.serialize(),
                    success: function (data) {
                        console.log('Submission was successful.');
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('An error occurred.');
                        console.log(data);
                    },
                });
            });
        })

        this.generateForm()
    }

    getData(url){
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

    createOption(value, title){
        return `<option value=\"${value}\">${title}</option>`
    }

    generateForm(){
        for (let i = 0; i < 3; i++) {
            let user = this.users[i + 1];
            this.usersElement.innerHTML += this.createOption(user.ID, user.name)
        }

        for (let i = 0; i < 5; i++) {
            let type = this.types[i + 1];
            this.typesElement.innerHTML += this.createOption(0, type.typ)
        }
    }



}

c = new CoffeeForm(document.getElementById("AddCoffeForm"))