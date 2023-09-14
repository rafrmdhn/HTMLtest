// Fungsi untuk menyimpan data buku ke local storage
function saveBooksToLocalStorage() {
    localStorage.setItem('bookshelfApp', JSON.stringify(books));
  }
  
  // Fungsi untuk mengambil data buku dari local storage
  function loadBooksFromLocalStorage() {
    const storedBooks = localStorage.getItem('bookshelfApp');
    if (storedBooks) {
      return JSON.parse(storedBooks);
    } else {
      return [];
    }
  }
  
document.addEventListener("DOMContentLoaded", function () {
    books = loadBooksFromLocalStorage();
  
    function addBookToMemory(title, author, year, isComplete) {
        const book = {
          id: +new Date(),
          title: title,
          author: author,
          year: year,
          isComplete: isComplete
        };
        books.push(book);
      
        // Menyimpan buku ke local storage setiap kali buku ditambahkan
        saveBooksToLocalStorage();
      }
  
      function redrawBookshelf() {
        let incompleteBookshelfList = document.getElementById("incompleteBookshelfList");
        let completeBookshelfList = document.getElementById("completeBookshelfList");
        incompleteBookshelfList.innerHTML = "";
        completeBookshelfList.innerHTML = "";
      
        books.forEach(function (book) {
          const bookItem = createBookItem(book.title, book.author, book.year, book.isComplete);
      
          const actionDiv = bookItem.querySelector(".action");
          const iconCheck = actionDiv.querySelector(".fas");
      
          iconCheck.addEventListener("click", function () {
            book.isComplete = !book.isComplete;
      
            if (book.isComplete) {
              completeBookshelfList.appendChild(bookItem);
            } else {
              incompleteBookshelfList.appendChild(bookItem);
            }
      
            // Menyimpan perubahan ke local storage saat buku diubah
            saveBooksToLocalStorage();
      
            redrawBookshelf();
          });
      
          if (book.isComplete) {
            completeBookshelfList.appendChild(bookItem);
          } else {
            incompleteBookshelfList.appendChild(bookItem);
          }
        });
      }
      
  
    redrawBookshelf();
  
    const inputBookForm = document.getElementById("inputBook");
    inputBookForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const inputBookTitle = document.getElementById("inputBookTitle").value;
        const inputBookAuthor = document.getElementById("inputBookAuthor").value;
        const inputBookYear = document.getElementById("inputBookYear").value;
        const inputBookIsComplete = document.getElementById("inputBookIsComplete").checked;

        addBookToMemory(inputBookTitle, inputBookAuthor, inputBookYear, inputBookIsComplete);
        redrawBookshelf();
        resetInputForm();
    });
  
    const searchBookForm = document.getElementById("searchBook");
    searchBookForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const searchBookTitle = document.getElementById("searchBookTitle").value.toLowerCase();
      searchBooks(searchBookTitle);
    });
  
    function searchBooks(keyword) {
      let incompleteBookshelfList = document.getElementById("incompleteBookshelfList");
      let completeBookshelfList = document.getElementById("completeBookshelfList");
      incompleteBookshelfList.innerHTML = "";
      completeBookshelfList.innerHTML = "";
  
      books.forEach(function (book) {
        if (book.title.toLowerCase().includes(keyword)) {
          const bookItem = createBookItem(book.title, book.author, book.year, book.isComplete);
  
          const actionDiv = bookItem.querySelector(".action");
          const iconCheck = actionDiv.querySelector(".fas");
  
          iconCheck.addEventListener("click", function () {
            book.isComplete = !book.isComplete;
  
            if (book.isComplete) {
              completeBookshelfList.appendChild(bookItem);
            } else {
              incompleteBookshelfList.appendChild(bookItem);
            }
  
            redrawBookshelf();
          });
  
          if (book.isComplete) {
            completeBookshelfList.appendChild(bookItem);
          } else {
            incompleteBookshelfList.appendChild(bookItem);
          }
        }
      });
    }
  
    function createBookItem(title, author, year, isComplete) {
      const bookItem = document.createElement("article");
      bookItem.classList.add("book_item");
  
      const h3 = document.createElement("h3");
      h3.textContent = title;
  
      const authorP = document.createElement("p");
      authorP.textContent = "Penulis : " + author;
  
      const yearP = document.createElement("p");
      yearP.textContent = "Tahun : " + year;
  
      const actionDiv = document.createElement("div");
      actionDiv.classList.add("action");
  
      const iconCheck = document.createElement("i");
      iconCheck.classList.add("fas", isComplete ? "fa-undo" : "fa-check");
      iconCheck.classList.add(isComplete ? "undo-button" : "check-button");

      const iconDelete = document.createElement("i");
      iconDelete.classList.add("fas", "fa-trash");
      iconDelete.classList.add("delete-button");
  
      iconDelete.addEventListener("click", function () {
        const confirmation = confirm("Apakah Anda yakin ingin menghapus buku ini?");
        if (confirmation) {
            books = books.filter((book) => book.title !== title);
            // Menyimpan perubahan ke local storage saat buku dihapus
            saveBooksToLocalStorage();
            redrawBookshelf();
        }
      });
  
      actionDiv.appendChild(iconCheck);
      actionDiv.appendChild(iconDelete);
  
      bookItem.appendChild(h3);
      bookItem.appendChild(authorP);
      bookItem.appendChild(yearP);
      bookItem.appendChild(actionDiv);
  
      return bookItem;
    }
  
    function resetInputForm() {
      document.getElementById("inputBookTitle").value = "";
      document.getElementById("inputBookAuthor").value = "";
      document.getElementById("inputBookYear").value = "";
      document.getElementById("inputBookIsComplete").checked = false;
    }
  });
  