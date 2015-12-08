import urllib.request
from bs4 import BeautifulSoup
from collections import OrderedDict
from sys import argv

RETAILERS = {
    "microcenter": "Micro Center",
    "directron": "Directron",
    "outletpc": "OutletPC",
    "ncixus": "NCIX US",
    "bhphotovideo": "B&H Photo Video",
    "bestbuy": "Best Buy",
    "newegg": "Newegg",
    "superbiiz": "SuperBiiz",
    "amazon": "Amazon",
    "macmall": "MacMall",
    "pcmall": "PC Mall",
    "adorama": "Adorama",
    "dellbusiness": "Dell Business",
    "otherworldcomputing": "Other World Computing",
    "nzxt": "NZXT"
}

class component:
    def __init__(self, comp_id, specs, name, prices):
        self.specs = specs
        self.prices = prices
        self.comp_id = comp_id

        self.sql_specs = OrderedDict()
        self.sql_specs["comp_id"] = comp_id
        self.sql_specs["name"] = name
        self.sql_specs["manufacturer"] = specs["Manufacturer"]

class comp_case(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["form_factor"] = self.specs["Motherboard Compatibility"].split(", ")[0]

class cpu(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["architecture"] = self.specs["Data Width"]
        self.sql_specs["socket"] = self.specs["Socket"]

class gpu(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["clock_speed"] = self.specs["Core Clock"]
        self.sql_specs["vram"] = self.specs["Memory Size"]

class motherboard(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["form_factor"] = self.specs["Form Factor"]
        self.sql_specs["socket"] = self.specs["CPU Socket"]

class psu(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["wattage"] = self.specs["Wattage"]

class ram(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["capacity"] = self.specs["Size"]
        self.sql_specs["speed"] = self.specs["Speed"]

class storage(component):
    def __init__(self, *args):
        super().__init__(*args)
        self.sql_specs["capacity"] = self.specs["Capacity"]
        self.sql_specs["type"] = "SSD" if self.specs["Cache"] == "N/A" else "HDD"

def main(comp_type, html_file):
    with open(html_file) as html:
        soup = BeautifulSoup(html, "html.parser")

    parts = []

    for name in soup.find_all("td", "tdname"):
        url = name.a.get("href")
        comp_id = url.split('/')[-1]
        parts.append(grab_part(comp_type, comp_id, url))

    write_sql(comp_type, parts)

def write_sql(comp_type, parts):
    with open("add_parts.sql", 'a') as sql_file:
        print("-- Insert {} components and prices".format(comp_type), file = sql_file)
        print("INSERT INTO `{}` (`{}`) VALUES".format(comp_type, "`, `".join(parts[0].sql_specs.keys())), file = sql_file)

        end = ',\n'
        for i, part in enumerate(parts):
            if i == len(parts) - 1:
                end = ';\n\n'

            print("('{}')".format("', '".join(part.sql_specs.values())), end = end, file = sql_file)

        print("INSERT INTO `sold_by` (`sold_id`, `retail_name`, `comp_id`, `price`) VALUES", file = sql_file)

        end = ',\n'
        for i, part in enumerate(parts):
            j = 0
            for retailer, price in part.prices.items():
                if i == len(parts) - 1 and j == len(part.prices.items()) - 1:
                    end = ';\n\n'

                print("('{}-{}', '{}', '{}', {})".format(retailer, part.comp_id, RETAILERS[retailer], part.comp_id, price), end = end, file = sql_file)
                j += 1

def grab_part(comp_type, comp_id, url):
    response = urllib.request.urlopen(url)
    soup = BeautifulSoup(response.read(), "html.parser")

    name = soup.find("h1", "name").string
    specs_block = soup.find("div", "specs block").find_all("h4")
    specs = {i.string: i.next_sibling.strip() for i in specs_block}

    prices_block = soup.find("div", "prices block")
    merchants = [i.parent.get("class")[0] for i in prices_block.find_all("td", "merchant")]
    prices = dict(zip(merchants, [i.a.contents[0][1:] for i in prices_block.find_all("td", "total")]))

    part = globals()[comp_type](comp_id, specs, name, prices)

    return part

if __name__ == "__main__":
    main(argv[1], argv[2])
