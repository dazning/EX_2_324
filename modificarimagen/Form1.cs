using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace imagenes
{
    public partial class Form1 : Form
    {
        int Rm, Gm, Bm;
        int Rmc, Gmc, Bmc, L = 10;
        private Color color1 = Color.Empty;
        private Color color2 = Color.Empty;
        private Color color3 = Color.Empty;

        string connectionString = "Server=localhost;Database=rgb;Uid=root;Pwd=;";
        MySqlConnection con;
        public Form1()
        {
            InitializeComponent();
            

            // Inicializar la conexión a MySQL
            con = new MySqlConnection(connectionString);

            // Abre la conexión a MySQL
            try
            {
                con.Open();
               
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error al establecer la conexión a MySQL: {ex.Message}", "Error de Conexión", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            finally
            {
                // Cierra la conexión a MySQL
                if (con.State == ConnectionState.Open)
                    con.Close();
            }
        }

      

       

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            openFileDialog1.FileName = string.Empty;
            openFileDialog1.Filter = "Archivo JPG|*.JPG|Archivos BMP|*.bmp";
            openFileDialog1.ShowDialog();
            if (openFileDialog1.FileName != string.Empty)
            {
                Bitmap bmp = new Bitmap(openFileDialog1.FileName);
                pictureBox1.Image = bmp;
            }
        }

        private void AplicarCambiosEnImagen(Dictionary<Color, Color> mapeoColores, int umbralDistancia)
        {
            try
            {
                Bitmap bmp = new Bitmap(pictureBox1.Image);
                Bitmap bmpModificado = new Bitmap(bmp.Width, bmp.Height);

                // Iterar sobre cada píxel en la imagen
                for (int i = 0; i < bmp.Width; i++)
                {
                    for (int j = 0; j < bmp.Height; j++)
                    {
                        Color colorOriginal = bmp.GetPixel(i, j);

                        // Buscar el color más cercano en el diccionario
                        Color colorCercano = EncontrarColorCercano(colorOriginal, mapeoColores, umbralDistancia);

                        // Asignar el color encontrado o mantener el original si no se encontró ninguno cercano
                        bmpModificado.SetPixel(i, j, colorCercano);
                    }
                }

                // Mostrar la imagen modificada en el PictureBox
                pictureBox1.Image = bmpModificado;
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error al aplicar cambios en la imagen: {ex.Message}", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        private Color EncontrarColorCercano(Color color, Dictionary<Color, Color> mapeoColores, int umbralDistancia)
        {
            Color colorCercano = color;

            foreach (var colorOriginal in mapeoColores.Keys)
            {
                int distancia = CalcularDistanciaColor(color, colorOriginal);

                if (distancia < umbralDistancia)
                {
                    umbralDistancia = distancia;
                    colorCercano = mapeoColores[colorOriginal];
                }
            }

            return colorCercano;
        }

        private int CalcularDistanciaColor(Color c1, Color c2)
        {
            int distanciaR = Math.Abs(c1.R - c2.R);
            int distanciaG = Math.Abs(c1.G - c2.G);
            int distanciaB = Math.Abs(c1.B - c2.B);

            return distanciaR + distanciaG + distanciaB;
        }
        private void button5_Click(object sender, EventArgs e)
        {
            if (color1 != Color.Empty && color2 != Color.Empty && color3 != Color.Empty)
            {
                // Obtener los últimos tres colores de la base de datos
                List<Color> coloresOriginales = ObtenerUltimosTresColores();

                // Crear un diccionario para mapear los colores originales a los nuevos
                Dictionary<Color, Color> mapeoColores = new Dictionary<Color, Color>
        {
            { coloresOriginales[0], color1 },
            { coloresOriginales[1], color2 },
            { coloresOriginales[2], color3 }
        };

                // Definir el umbral de distancia para buscar colores cercanos
                int umbralDistancia = 50; // ajusta según tus necesidades

                // Aplicar los cambios en la imagen
                AplicarCambiosEnImagen(mapeoColores, umbralDistancia);
            }
            else
            {
                MessageBox.Show("Por favor, selecciona los tres colores antes de modificar.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }



        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (colorDialog1.ShowDialog() == DialogResult.OK)
            {
                color1 = colorDialog1.Color;
                button2.BackColor = color1;
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (colorDialog1.ShowDialog() == DialogResult.OK)
            {
                color2 = colorDialog1.Color;
                button3.BackColor = color2;
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (colorDialog1.ShowDialog() == DialogResult.OK)
            {
                color3 = colorDialog1.Color;
                button4.BackColor = color3;
            }
        }

        private void textBox3_TextChanged(object sender, EventArgs e)
        {

        }

        private List<Color> ObtenerUltimosTresColores()
        {
            List<Color> colores = new List<Color>();

            try
            {
                // Abrir la conexión a MySQL
                con.Open();

                // Consulta SQL para obtener los últimos tres colores de la base de datos
                string query = "SELECT R, G, B FROM colores ORDER BY Id DESC LIMIT 3";

                using (MySqlCommand cmd = new MySqlCommand(query, con))
                using (MySqlDataReader reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        int r = Convert.ToInt32(reader["R"]);
                        int g = Convert.ToInt32(reader["G"]);
                        int b = Convert.ToInt32(reader["B"]);
                        colores.Add(Color.FromArgb(r, g, b));
                    }
                }
            }
            catch (Exception ex)
            {
                // Manejar el error si es necesario
                MessageBox.Show($"Error al obtener los últimos tres colores de la base de datos: {ex.Message}", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            finally
            {
                // Cerrar la conexión a MySQL
                if (con.State == ConnectionState.Open)
                    con.Close();
            }

            return colores;
        }


      

        private void GuardarColorEnBaseDeDatos(Color color)
        {
            try
            {
                // Abrir la conexión a MySQL
                con.Open();

                // Consulta SQL para insertar el color en la base de datos
                string query = "INSERT INTO colores (R, G, B) VALUES (@R, @G, @B)";

                using (MySqlCommand cmd = new MySqlCommand(query, con))
                {
                    // Parámetros de la consulta
                    cmd.Parameters.AddWithValue("@R", color.R);
                    cmd.Parameters.AddWithValue("@G", color.G);
                    cmd.Parameters.AddWithValue("@B", color.B);

                    // Ejecutar la consulta
                    cmd.ExecuteNonQuery();

                    // Mostrar un mensaje de éxito
                    MessageBox.Show("Color guardado en la base de datos correctamente", "Éxito", MessageBoxButtons.OK, MessageBoxIcon.Information);
                }
            }
            catch (Exception ex)
            {
                // Mostrar un mensaje de error si ocurre un problema
                MessageBox.Show($"Error al guardar el color en la base de datos: {ex.Message}", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            finally
            {
                // Cerrar la conexión a MySQL
                if (con.State == ConnectionState.Open)
                    con.Close();
            }
        }
        private int coloresCapturadosCount = 0;
        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            // Obtener el color del píxel en las coordenadas del clic
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = bmp.GetPixel(e.X, e.Y);

            // Guardar el color en la base de datos
            GuardarColorEnBaseDeDatos(c);         
            Rm = c.R;
            Gm = c.G;
            Bm = c.B;
            Rmc = 0; Gmc = 0; Bmc = 0;
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
            

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

      


    }
}
