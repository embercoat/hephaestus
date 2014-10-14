<h1>Tärningsspel</h1>
<p>Ta dig till 100 på så få rundor som möjligt</p>
<p>Slå så många gånger du vill per runda. Slår du 1 förlorar du rundan och alla poäng du samlat under rundan.</p>
<br>
<table>
    <tbody>
        <tr>
            <td style="width: 200px;">Omgång</td>
            <td><?php echo $round; ?></td>
        </tr>
        <tr>
            <td>Senaste Slag</td>
            <td><?php echo $last_roll; ?></td>
        </tr>
        <tr>
            <td>Poäng denna omgång</td>
            <td><?php echo $sum_round; ?></td>
        </tr>
        <tr>
            <td>Poäng totalt</td>
            <td><?php echo $sum_all; ?></td>
        </tr>
    </tbody>
</table>
<br>
<p>
<a href="/kmom2/roll">Slå Tärning</a><br>
<a href="/kmom2/next">Nästa omgång</a><br>
<a href="/kmom2/clear">Rensa data och börja om</a><br>
</p>
<br>
<p>
    Skriptet använder en bunt klasser som är inblandade i varierande grad.
    <a href="/csource/?path=model/kmom2/dicegame.php">Dicegame</a> bygger på <a href="/csource/?path=model/kmom2/gamedata.php">gamedata</a> som sköter hur och var data lagras genom sessionen. Till dessa hör en <a href="/csource/?path=model/kmom2/randomize.php">randomizer</a> som sköter själva slumpandet av tärningsslaget. 
</p>
