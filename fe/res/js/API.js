const ruta = "http://donlolo.lan/restAPI/data/fe";

export const traeProveedores = async () => {
  try {
    const resultado = await fetch(`${ruta}/traeProveedores`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=UTF-8", // Y le decimos que los datos se enviaran como JSON
      },
    });
    const datos = await resultado.json();
    return datos;
  } catch (error) {
    console.log(error);
  }
};