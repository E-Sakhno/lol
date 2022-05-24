Yone_class = document.getElementsByClassName('777');
// console.log(Yone_class.innerHTML);
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('sortable3');
    const headers = table.querySelectorAll('th');
    const tableBody = table.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    // Направление сортировки
    const directions = Array.from(headers).map(function(header) {
        return '';
    });

    // Преобразовать содержимое данной ячейки в заданном столбце
    const transform = function(index, content) {
        // Получить тип данных столбца
        const type = headers[index].getAttribute('data-type');
        switch (type) {
            case 'number':
                // console.log(content);
                return parseFloat(content);
            case 'string':
            default:
                // console.log(content);

                return content;
        }
    };

    const sortColumn = function(index) {
        // Получить текущее направление
        const direction = directions[index] || 'asc';

        // Фактор по направлению
        const multiplier = (direction === 'asc') ? 1 : -1;

        const newRows = Array.from(rows);

        newRows.sort(function(rowA, rowB) {
            const cellA = rowA.querySelectorAll('td')[index].innerHTML.replaceAll("&nbsp;", "");
            const cellB = rowB.querySelectorAll('td')[index].innerHTML.replaceAll("&nbsp;", "");

            const a = transform(index, cellA);
            const b = transform(index, cellB);    

            switch (true) {
                case a > b: return 1 * multiplier;
                case a < b: return -1 * multiplier;
                case a === b: return 0;
            }
        });

        // Удалить старые строки
        [].forEach.call(rows, function(row) {
            tableBody.removeChild(row);
        });

        // Поменять направление
        directions[index] = direction === 'asc' ? 'desc' : 'asc';

        // Добавить новую строку
        newRows.forEach(function(newRow) {
            tableBody.appendChild(newRow);
        });
    };

    [].forEach.call(headers, function(header, index) {
        header.addEventListener('click', function() {

        if (Yone_class){
            for(var i=0; i<Yone_class.length; i++ ) {
                var Yone_class_cur = Yone_class[i];
                Yone_class2 = Yone_class_cur.innerHTML.replaceAll('Ёнэ', "Енэ"); Yone_class_cur.innerHTML = Yone_class2;
           }}
        sortColumn(index);
        if (Yone_class){
            for(var i=0; i<Yone_class.length; i++ ) {
                var Yone_class_cur = Yone_class[i];
                Yone_class2 = Yone_class_cur.innerHTML.replaceAll('Енэ', "Ёнэ"); Yone_class_cur.innerHTML = Yone_class2;
           }}
        
        });
    });
});