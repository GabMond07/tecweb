<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd"/>
    <xsl:template match="/">
        <html lang="es">
            <head>
                <style type="text/css">
                    body {
                    margin: 20px;
                    background-color: #221f1f; /* Fondo en tono oscuro característico de Netflix */
                    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                    font-size: 90%;
                    color: #fff; /* Texto en color blanco */
                    }
                    
                    h1 {
                    color: #e50914; /* Rojo característico de Netflix para el título principal */
                    border-bottom: 1px solid #e50914;
                    }
                    
                    h2 {
                    font-size: 1.2em;
                    color: #e50914; /* Rojo característico de Netflix para los subtítulos */
                    }
                    
                    table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                    }
                    
                    th, td {
                    border: 1px solid #e50914; /* Borde en rojo característico de Netflix */
                    padding: 8px;
                    text-align: left;
                    color: #fff; /* Texto en color blanco */
                    }
                    
                    th {
                    background-color: #221f1f; /* Fondo oscuro para el encabezado de la tabla */
                    }
                </style>
                
                <meta charset="UTF-8"/>
                <title>CatalogoVOD</title>
            </head>
            <body>
                <header>
                    <img src="logo.jpg" alt="Logo de CatalogoVOD" style="width: 100px; height: auto;"/>
                    <h1>CatalogoVOD</h1>
                </header>
                <section id="perfiles">
                    <h2>Perfiles</h2>
                    <ul>
                        <xsl:for-each select="CatalogoVOD/cuenta/perfiles/perfil">
                            <li>
                                <strong><xsl:value-of select="@usuario"/></strong>
                                <span> - Idioma: <xsl:value-of select="@idioma"/></span>
                            </li>
                        </xsl:for-each>
                    </ul>
                </section>
                <section id="contenido">
                    <h2>Contenido</h2>
                    <xsl:apply-templates select="CatalogoVOD/contenido"/>
                </section>
            </body>
        </html>
    </xsl:template>
    
    <xsl:template match="peliculas | series">
        <xsl:element name="{name()}">
            <xsl:attribute name="region">
                <xsl:value-of select="@region"/>
            </xsl:attribute>
            <h3>
                <xsl:value-of select="translate(name(), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')"/>
            </h3>
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Duración</th>
                        <th>Género</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:apply-templates select="genero/titulo"/>
                </tbody>
            </table>
        </xsl:element>
    </xsl:template>
    
    <xsl:template match="titulo">
        <tr>
            <td><xsl:value-of select="."/></td>
            <td><xsl:value-of select="@duracion"/></td>
            <td><xsl:value-of select="../@nombre"/></td>
        </tr>
    </xsl:template>
    
</xsl:stylesheet>
