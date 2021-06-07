$('.supr_btn').click((e) => {
  const productID = e.target.name;
  //revoyer l'id de l'item pour le supprimer dans la bdd...
  $.ajax({
    url: '/all_products',
    method: 'POST',
    data: {
      supr: 1,
      productID,
    },
    success: (user) => {
      console.log('deletion request sent ' + user);
    },
  });
});
